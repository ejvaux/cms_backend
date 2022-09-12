<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionHistoryUpdateStocksTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER [dbo].[UpdateStocks]
            ON  [dbo].[transaction_history]
            INSTEAD OF UPDATE
            AS
            BEGIN
                -- SET NOCOUNT ON added to prevent extra result sets from
                -- interfering with SELECT statements.
                SET NOCOUNT ON;

                DECLARE @transaction_id int;
                DECLARE @current_status_id int;
                DECLARE @outcome_id int;
                DECLARE @process_id int;
                DECLARE @hierarchy_id int;
                DECLARE @context_id int;
                DECLARE @operation varchar(10);
                DECLARE @sqlcmd nvarchar(256);
                DECLARE @items TABLE (Sl int identity,id int, transaction_id int, item_id int, quantity int);

                -- For item loop
                DECLARE @counter int = 0;
                DECLARE @item_id int;
                DECLARE @quantity int;
                DECLARE @stocks int;
                DECLARE @calc_stocks int;
                DECLARE @part_number varchar(256);
                DECLARE @uom varchar(256);

                -- Get transaction id,current status and outcome
                SELECT
                    @transaction_id = transaction_id,
                    @current_status_id = wf_state_type_state_id,
                    @outcome_id = wf_state_type_outcome_id
                FROM inserted;

                -- Get process id
                SELECT
                    @process_id = transaction_type_id
                FROM transactions
                WHERE id = @transaction_id;

                -- Get hierarchy id
                SELECT
                    @hierarchy_id = id
                FROM dbo.workflow_state_hierarchy
                WHERE state_type_parent_id = @current_status_id and state_type_child_id = @outcome_id

                -- Get context id
                SELECT
                    @context_id = id
                FROM dbo.workflow_state_context wsc
                WHERE state_type_id = @process_id and state_hierarchy_id = @hierarchy_id

                -- Get operation
                SELECT
                    @operation = operation
                FROM dbo.stock_update_settings
                WHERE state_context_id = @context_id

                --Get transaction items
                INSERT INTO @items
                SELECT id,transaction_id, item_id, quantity FROM transaction_items where transaction_id = @transaction_id;

                IF @operation is not null
                BEGIN
                    WHILE (1=1)
                        BEGIN
                            SET @Counter +=1;
                            SET @item_id = null;
                            SET @sqlcmd = '';
                            SET @stocks = 0;

                            SELECT @item_id = item_id,@quantity = quantity FROM @items WHERE SL = @counter;

                            IF @item_id is null
                                break;

                            SELECT @stocks = quantity FROM item_stocks WHERE item_id = @item_id

                            DECLARE @res int;
                            DECLARE @form  nvarchar(120) = CONCAT('SELECT @res=',@stocks,@operation,@quantity);
                            EXEC sp_executesql @form, N'@res INT OUTPUT',@res =  @res OUTPUT

                            IF SIGN(@res) = -1
                                BEGIN

                                    SELECT @part_number = i.part_number, @uom = u.name
                                    FROM dbo.items i
                                    INNER JOIN dbo.units u
                                    ON u.id = i.unit_id
                                    WHERE i.id = @item_id

                                    RAISERROR ('NOT ENOUGH AVAILABLE STOCKS!

                                    ITEM: %s
                                    AVAILABLE: %d %s',11,1,@part_number,@stocks,@uom) WITH NOWAIT;
                                    ROLLBACK;

                                END

                            ELSE
                                BEGIN
                                    SET @sqlcmd = CONCAT('UPDATE item_stocks SET quantity ',@operation,'= @q,updated_at = CURRENT_TIMESTAMP WHERE item_id = ',@item_id);
                                    EXEC sp_executesql @sqlcmd, N'@q INT',@q =  @quantity;

                                    IF @@ROWCOUNT = 0
                                        BEGIN
                                        INSERT INTO item_stocks (item_id,quantity,updated_at) VALUES (@item_id,@quantity,CURRENT_TIMESTAMP);
                                        END
                                END
                        END
                END

                -- Continue updating transaction_history. . .
                UPDATE
                    ti
                SET
                    ti.transaction_id = i.transaction_id,
                    ti.remarks = i.remarks,
                    ti.wf_state_type_state_id = i.wf_state_type_state_id,
                    ti.wf_state_type_outcome_id = i.wf_state_type_outcome_id,
                    ti.wf_state_type_qual_id = i.wf_state_type_qual_id,
                    ti.agent = i.agent,
                    ti.due_date = i.due_date,
                    ti.updated_at = i.updated_at
                FROM
                    transaction_history ti
                    INNER JOIN inserted i
                    ON ti.id = i.id
                WHERE
                    ti.id = i.id



                --RAISERROR ('Test trigger raise error %d',11,1,@var) WITH NOWAIT;
                --ROLLBACK;

            END

        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER UpdateStocks');
    }
}

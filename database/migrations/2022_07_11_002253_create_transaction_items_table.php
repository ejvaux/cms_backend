<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('quantity');
            $table->string('remarks');
            $table->timestamp('updated_at');
        });
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('item_id')->references('id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('transaction_items');
        Schema::enableForeignKeyConstraints();
    }
}

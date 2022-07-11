<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->foreign('item_type_id')->references('id')->on('item_types');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('item_location_id')->references('id')->on('item_locations');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('site_id')->references('id')->on('sites');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('requested_by')->references('id')->on('requestors');
            $table->foreign('station_id')->references('id')->on('stations');
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('shift_id')->references('id')->on('shifts');
            $table->foreign('received_by')->references('id')->on('requestors');
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['vendor_id']);
            $table->dropForeign(['item_type_id']);
            $table->dropForeign(['unit_id']);
            $table->dropForeign(['item_location_id']);
            $table->dropForeign(['department_id']);
            $table->dropForeign(['site_id']);
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['requested_by']);
            $table->dropForeign(['station_id']);
            $table->dropForeign(['transaction_type_id']);
            $table->dropForeign(['location_id']);
            $table->dropForeign(['shift_id']);
            $table->dropForeign(['received_by']);
            $table->dropForeign(['department_id']);
        });
    }
}

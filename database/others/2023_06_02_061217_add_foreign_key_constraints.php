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
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('shift_id')->references('id')->on('shifts');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('site_id')->references('id')->on('sites');
            $table->foreign('transaction_type_id')->references('id')->on('workflow_state_type');
        });
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('item_id')->references('id')->on('items');
        });
        Schema::table('item_stocks', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items');
        });
        Schema::table('transaction_history', function (Blueprint $table) {
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('wf_state_type_state_id')->references('id')->on('workflow_state_type');
            $table->foreign('wf_state_type_outcome_id')->references('id')->on('workflow_state_type');
            $table->foreign('wf_state_type_qual_id')->references('id')->on('workflow_state_type');
        });
        Schema::table('workflow_state_type', function (Blueprint $table) {
            $table->foreign('workflow_level_type_id')->references('id')->on('workflow_level_type');
        });
        Schema::table('workflow_state_option', function (Blueprint $table) {
            $table->foreign('state_context_id')->references('id')->on('workflow_state_context');
            $table->foreign('state_type_id')->references('id')->on('workflow_state_type');
        });
        Schema::table('workflow_state_hierarchy', function (Blueprint $table) {
            $table->foreign('state_type_parent_id')->references('id')->on('workflow_state_type');
            $table->foreign('state_type_child_id')->references('id')->on('workflow_state_type');
        });
        Schema::table('workflow_state_context', function (Blueprint $table) {
            $table->foreign('state_type_id')->references('id')->on('workflow_state_type');
            $table->foreign('state_hierarchy_id')->references('id')->on('workflow_state_hierarchy');
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
            $table->dropForeign(['location_id']);
            $table->dropForeign(['shift_id']);
            $table->dropForeign(['department_id']);
            $table->dropForeign(['site_id']);
            $table->dropForeign(['transaction_type_id']);
        });
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->dropForeign(['transaction_id']);
            $table->dropForeign(['item_id']);
        });
        Schema::table('item_stocks', function (Blueprint $table) {
            $table->dropForeign(['item_id']);
        });
        Schema::table('transaction_history', function (Blueprint $table) {
            $table->dropForeign(['transaction_id']);
            $table->dropForeign(['wf_state_type_state_id']);
            $table->dropForeign(['wf_state_type_outcome_id']);
            $table->dropForeign(['wf_state_type_qual_id']);
        });
        Schema::table('workflow_state_type', function (Blueprint $table) {
            $table->dropForeign(['workflow_level_type_id']);
        });
        Schema::table('workflow_state_option', function (Blueprint $table) {
            $table->dropForeign(['state_context_id']);
            $table->dropForeign(['state_type_id']);
        });
        Schema::table('workflow_state_hierarchy', function (Blueprint $table) {
            $table->dropForeign(['state_type_parent_id']);
            $table->dropForeign(['state_type_child_id']);
        });
        Schema::table('workflow_state_context', function (Blueprint $table) {
            $table->dropForeign(['state_type_id']);
            $table->dropForeign(['state_hierarchy_id']);
        });
    }
}

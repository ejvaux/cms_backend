<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('part_number');
            $table->string('chinese_name')->nullable();
            $table->string('description');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->string('allocation')->nullable();
            $table->unsignedBigInteger('item_type_id')->nullable();
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('item_location_id')->nullable();
            $table->unsignedInteger('min');
            $table->unsignedInteger('max')->nullable();
            $table->string('lead_time')->nullable();
            $table->binary('image')->nullable();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('site_id');
            $table->timestamps();
            $table->unique(['part_number', 'department_id', 'site_id']);
        });

        Schema::table('items', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->foreign('item_type_id')->references('id')->on('item_types');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('item_location_id')->references('id')->on('item_locations');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('site_id')->references('id')->on('sites');
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
        Schema::dropIfExists('items');
        Schema::enableForeignKeyConstraints();
    }
}

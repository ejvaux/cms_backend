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
            $table->string('part_number')->unique()->index();
            $table->string('chinese_name')->nullable();
            $table->string('description');
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('vendor_id')->nullable();
            $table->unsignedInteger('allocation_id')->nullable();
            $table->unsignedInteger('item_type_id')->nullable();
            $table->unsignedInteger('unit_id');
            $table->unsignedInteger('item_location_id')->nullable();
            $table->unsignedInteger('min');
            $table->unsignedInteger('max')->nullable();
            $table->string('lead_time')->nullable();
            $table->binary('image')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->foreign('allocation_id')->references('id')->on('allocations');
            $table->foreign('item_type_id')->references('id')->on('item_types');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('item_location_id')->references('id')->on('item_locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}

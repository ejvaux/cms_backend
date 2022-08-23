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

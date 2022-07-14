<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number');
            $table->unsignedBigInteger('requested_by');
            $table->unsignedBigInteger('station_id')->nullable();
            $table->unsignedBigInteger('transaction_type_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('shift_id');
            $table->string('approved_by');
            $table->string('updated_by');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('site_id');
            $table->timestamps();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('requested_by')->references('id')->on('requestors');
            $table->foreign('station_id')->references('id')->on('stations');
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('shift_id')->references('id')->on('shifts');
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
        Schema::dropIfExists('transactions');
        Schema::enableForeignKeyConstraints();
    }
}

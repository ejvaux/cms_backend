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
            $table->unsignedBigInteger('received_by');
            $table->string('updated_by');
            $table->unsignedBigInteger('department_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}

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
            $table->string('part_number')->index();
            $table->integer('quantity');
            $table->unsignedInteger('requestor_id');
            $table->unsignedInteger('station_id')->nullable();
            $table->unsignedInteger('transaction_type_id');
            $table->unsignedInteger('location_id');
            $table->unsignedInteger('shift_id');
            $table->string('remarks')->nullable();
            $table->string('user_id');
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

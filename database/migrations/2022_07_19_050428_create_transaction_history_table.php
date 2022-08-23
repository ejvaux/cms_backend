<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('wf_state_type_state_id');
            $table->unsignedBigInteger('wf_state_type_outcome_id')->nullable();
            $table->unsignedBigInteger('wf_state_type_qual_id')->nullable();
            $table->string('agent')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_history');
    }
}

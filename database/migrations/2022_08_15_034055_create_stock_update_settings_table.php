<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockUpdateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_update_settings', function (Blueprint $table) {
            $table->id();
            $table->string('operation');
            $table->unsignedBigInteger('transaction_type_id')->nullable();
            $table->unsignedBigInteger('state_context_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_update_settings');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkflowStateContextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflow_state_context', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('state_type_id');
            $table->unsignedBigInteger('state_hierarchy_id');
            $table->string('child_disabled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workflow_state_context');
    }
}

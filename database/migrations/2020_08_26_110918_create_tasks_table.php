<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->bigInteger('status_id')
                ->nullable();
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses');
            $table->bigInteger('created_by_id');
            $table->foreign('created_by_id')
                ->references('id')
                ->on('users');
            $table->bigInteger('assigned_to_id')
                ->nullable();
            $table->foreign('assigned_to_id')
                ->references('id')
                ->on('users');
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
        Schema::dropIfExists('tasks');
    }
}

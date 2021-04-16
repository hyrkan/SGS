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
            $table->string('task_name');
            $table->string('task_schedule');
            $table->boolean('task_status')->default(1);
            $table->foreignId('seed_plot_id');
            $table->foreignId('pesticide_id')->nullable();
            $table->foreignId('fertilizer_id')->nullable();
            $table->integer('fertilizer_bags_used')->nullable();
            $table->integer('pesticide_containers_used')->nullable();
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

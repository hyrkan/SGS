<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHarvestLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harvest_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seed_plot_id');
            $table->foreignId('plot_id');
            $table->foreignId('seed_id');
            $table->integer('low_quality');
            $table->integer('harvested');
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
        Schema::dropIfExists('harvest_logs');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeedPlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_plots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plot_id');
            $table->foreignId('seed_id');
            $table->string('seedling_name');
            $table->string('seedling_variety');
            $table->integer('quantity');
            $table->string('date_harvest');
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
        Schema::dropIfExists('seed_plots');
    }
}

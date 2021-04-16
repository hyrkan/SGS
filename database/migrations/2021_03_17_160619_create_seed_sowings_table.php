<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeedSowingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_sowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seed_id');
            $table->foreignId('seedbed_id');
            $table->integer('quantity');
            $table->string('start');
            $table->string('date_transfer');
            $table->string('status')->default('0');
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
        Schema::dropIfExists('seed_sowings');
    }
}

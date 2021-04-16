<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesticideStockInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesticide_stock_ins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('pesticide_id');
            $table->integer('quantity_added');
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
        Schema::dropIfExists('pesticide_stock_ins');
    }
}

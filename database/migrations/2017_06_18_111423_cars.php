<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id_car');
            $table->string('car_brand', 100);
            $table->string('car_model', 100);
            $table->string('car_engine', 80);
            $table->string('car_color', 80);
            $table->string('car_photo_dir');
            $table->integer('car_price');
            $table->foreign('car_brand')->references('brand')->on('car_brands');
            $table->foreign('car_model')->references('model')->on('models_brand');
            $table->foreign('car_engine')->references('engines')->on('car_engines');
            $table->foreign('car_color')->references('colors')->on('colors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

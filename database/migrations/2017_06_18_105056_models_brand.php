<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModelsBrand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models_brand', function (Blueprint $table) {
            $table->string('model', 100)->unique();
            $table->string('brand', 100);
            $table->foreign('brand')
                    ->references('brand')
                    ->on('car_brands')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('models_brand');
    }
}

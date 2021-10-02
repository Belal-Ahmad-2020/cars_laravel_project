<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarProductDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_product_dates', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('car_model_id');
            $table->date('created_at');            
            
            $table->foreign('car_model_id')
            ->references('id')
            ->on('car_models')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_product_dates');
    }
}

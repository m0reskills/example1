<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoffeeAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coffee_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')
                ->on('products')->onUpdate('cascade')->onDelete('set null');
            $table->integer('arabica_percent')->nullable();
            $table->integer('robusta_percent')->nullable();
            $table->string('origin')->nullable();
            $table->integer('bitterness')->nullable();
            $table->integer('density')->nullable();
            $table->integer('strong')->nullable();
            $table->integer('aroma')->nullable();
            $table->string('uses')->nullable();
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
        Schema::dropIfExists('coffee_attributes');
    }
}

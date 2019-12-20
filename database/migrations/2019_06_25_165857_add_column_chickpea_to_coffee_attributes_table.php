<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnChickpeaToCoffeeAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coffee_attributes', function (Blueprint $table) {
            $table->integer('chickpea_percent')->nullable()->after('robusta_percent');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coffee_attributes', function (Blueprint $table) {
            $table->dropColumn('chickpea_percent');
        });
    }
}

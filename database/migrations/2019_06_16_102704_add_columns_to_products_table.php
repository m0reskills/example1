<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('image_alt')->after('image')->default('image alt name');
            $table->string('meta_keywords')->after('image_alt')->default('keywords');
            $table->string('meta_description')->after('meta_keywords')->default('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image_alt');
            $table->dropColumn('meta_keywords');
            $table->dropColumn('meta_description');

        });
    }
}

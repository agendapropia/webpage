<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_menu')->create('store_categories', function (
            Blueprint $table
        ) {
            $table->id();
            $table->boolean('status')->index();
            $table->bigInteger('store_id')->index();
            $table->bigInteger('category_id')->index();
            $table->string('name', 100);
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
        Schema::connection('mysql_menu')->dropIfExists('store_categories');
    }
}

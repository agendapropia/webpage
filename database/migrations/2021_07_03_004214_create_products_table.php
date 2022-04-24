<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_menu')->create('products', function (
            Blueprint $table
        ) {
            $table->id();
            $table->boolean('status')->index();
            $table->bigInteger('store_id')->index();
            $table->bigInteger('user_id')->index();
            $table->string('name', 100);
            $table->string('description', 256);
            $table->string('image', 256);
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
        Schema::connection('mysql_menu')->dropIfExists('products');
    }
}

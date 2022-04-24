<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToppingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_menu')->create('toppings', function (
            Blueprint $table
        ) {
            $table->id();
            $table->boolean('status');
            $table->bigInteger('store_id')->index();
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
        Schema::connection('mysql_menu')->dropIfExists('toppings');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductToppingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_menu')->create('product_toppings', function (
            Blueprint $table
        ) {
            $table->id();
            $table->boolean('status')->index;
            $table->bigInteger('product_id')->index;
            $table->bigInteger('product_group_id')->index;
            $table->bigInteger('topping_id')->index;
            $table->decimal('price', 13, 4);
            $table->integer('position');
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
        Schema::connection('mysql_menu')->dropIfExists('product_toppings');
    }
}

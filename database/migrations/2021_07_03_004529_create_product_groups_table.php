<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_menu')->create('product_groups', function (
            Blueprint $table
        ) {
            $table->id();
            $table->bigInteger('product_id')->index();
            $table->string('name', 100);
            $table->string('description', 256);
            $table->integer('position');
            $table->integer('min');
            $table->integer('max');
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
        Schema::connection('mysql_menu')->dropIfExists('product_groups');
    }
}

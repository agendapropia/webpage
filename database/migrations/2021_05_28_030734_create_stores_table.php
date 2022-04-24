<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_stores')->create('stores', function (
            Blueprint $table
        ) {
            $table->integerIncrements('id');
            $table->integer('store_type_id')->index();
            $table->integer('store_status_id')->index();
            $table->integer('city_id')->index();
            $table->string('uuid', 50)->unique();
            $table->string('name', 120);
            $table->string('name_short', 40);
            $table->string('details', 200);
            $table->string('address', 120);
            $table->string('phone_code', 20);
            $table->string('phone_number', 20);
            $table->double('latitude');
            $table->double('longitude');
            $table->string('icon');
            $table->string('image');
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
        Schema::connection('mysql_stores')->dropIfExists('stores');
    }
}

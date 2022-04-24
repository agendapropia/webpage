<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_stores')->create('store_types', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->boolean('status')->index();
            $table->string('uuid', 50)->unique();
            $table->string('name', 120);
            $table->string('name_short', 40);
            $table->string('details', 200);
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
        Schema::connection('mysql_stores')->dropIfExists('store_types');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlliedMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_articules')->create('allied_media', function (
            Blueprint $table
        ) {
            $table->integerIncrements('id');
            $table->string('name', 256);
            $table->string('icon', 256);
            $table->string('url', 256);
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
        Schema::connection('mysql_articules')->dropIfExists('allied_media');
    }
}

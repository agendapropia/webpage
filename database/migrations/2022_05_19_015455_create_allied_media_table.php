<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->string('image')->nullable();
            $table->string('url', 256);
            $table->timestamps();
        });

        DB::statement(
            'ALTER TABLE agendapropia_articules.allied_media AUTO_INCREMENT = 1000;'
        );
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

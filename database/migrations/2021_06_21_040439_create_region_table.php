<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_utils')->create('regions', function (
            Blueprint $table
        ) {
            $table->integerIncrements('id');
            $table->integer('country_id')
                ->index()
                ->comment('relates to field agendapropia-users.countries.id');;
            $table->string('name', 100);
            $table->string('image', 256);
            $table->string('icon', 256);
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
        Schema::connection('mysql_utils')->dropIfExists('regions');
    }
}

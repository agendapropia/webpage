<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialAlliedMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_articles')->create(
            'special_allied_media',
            function (Blueprint $table) {
                $table->integerIncrements('id');
                $table->integer('special_id')->index();
                $table->integer('allied_media_id')->index();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_articles')->dropIfExists(
            'special_allied_media'
        );
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_articules')->create(
            'special_images',
            function (Blueprint $table) {
                $table->integerIncrements('id');
                $table->integer('special_id')->index();
                $table->integer('image_id')->index()->comment('Se relaciona con la tabla agendapropia_utils.images');
                $table->string('type')->index();
                $table->integer('position');
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
        Schema::connection('mysql_articules')->dropIfExists('special_images');
    }
}

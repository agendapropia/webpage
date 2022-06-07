<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSpecialFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_articules')->create(
            'special_files',
            function (Blueprint $table) {
                $table->integerIncrements('id');
                $table->integer('special_id')->index();
                $table->integer('file_id')->index()->comment('Se relaciona con la tabla agendapropia_utils.files');
                $table->string('type')->index();
                $table->integer('position');
                $table->timestamps();
            }
        );

        DB::statement('ALTER TABLE agendapropia_articules.special_files AUTO_INCREMENT = 1000;');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_articules')->dropIfExists('special_files');
    }
}

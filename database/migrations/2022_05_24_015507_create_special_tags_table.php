<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_articules')->create('special_tags', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('special_id')->index();
            $table->integer('tag_id')->index()->comment('Relaciona con la tabla agendapropia_utils.tags');
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
        Schema::connection('mysql_articules')->dropIfExists('special_tags');
    }
}

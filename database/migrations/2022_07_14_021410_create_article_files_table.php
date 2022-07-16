<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateArticleFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_articles')->create(
            'article_files',
            function (Blueprint $table) {
                $table->integerIncrements('id');
                $table->integer('article_id')->index();
                $table->integer('file_id')->index()->comment('Se relaciona con la tabla agendapropia_utils.files');
                $table->string('type')->index();
                $table->integer('position');
                $table->timestamps();
            }
        );

        DB::statement('ALTER TABLE agendapropia_articles.article_files AUTO_INCREMENT = 1000;');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_articles')->dropIfExists('article_files');
    }
}

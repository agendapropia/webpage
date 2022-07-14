<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_articles')->create('article_tags', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('article_id')->index();
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
        Schema::connection('mysql_articles')->dropIfExists('article_tags');
    }
}

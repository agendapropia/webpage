<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_articles')->create(
            'article_contents',
            function (Blueprint $table) {
                $table->integerIncrements('id');
                $table
                    ->integer('article_id')
                    ->index()
                    ->comment(
                        'Relación con la tabla agendapropia_articles.articles'
                    );
                $table
                    ->integer('language_id')
                    ->index()
                    ->comment(
                        'Relación con la tabla agendapropia_utils.language'
                    );
                $table->boolean('status_id')->index();
                $table->string('title', 256)->nullable();
                $table->string('subtitle', 256)->nullable();
                $table->text('summary')->nullable();
                $table->longText('content')->nullable();
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
        Schema::connection('mysql_articles')->dropIfExists('article_contents');
    }
}

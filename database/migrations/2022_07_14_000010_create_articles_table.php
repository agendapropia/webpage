<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_articles')->create('articles', function (
            Blueprint $table
        ) {
            $table->integerIncrements('id');
            $table->string('slug', 150)->unique();
            $table
                ->integer('status_id')
                ->index()
                ->comment(
                    'Relación con la tabla agendapropia_articles.special_status'
                );
            $table
                ->integer('article_type_id')
                ->index()
                ->comment(
                    'Relación con la tabla agendapropia_articles.article_types'
                );
            $table
                ->integer('special_id')
                ->index()
                ->comment(
                    'Relación con la tabla agendapropia_articles.specials'
                );
            $table->string('name', 150);
            $table->date('publication_date');
            $table->double('number_views');
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
        Schema::connection('mysql_articles')->dropIfExists('articles');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_articles')->create(
            'article_countries',
            function (Blueprint $table) {
                $table->integerIncrements('id');
                $table->integer('article_id')->index();
                $table
                    ->integer('country_id')
                    ->index()
                    ->comment(
                        'Se relaciona con la tabla de agendapropia_users.countries'
                    );
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
            'article_countries'
        );
    }
}

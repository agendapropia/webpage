<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_articles')->create(
            'article_regions',
            function (Blueprint $table) {
                $table->integerIncrements('id');
                $table->integer('article_id')->index();
                $table
                    ->integer('region_id')
                    ->index()
                    ->comment(
                        'Se relaciona con la tabla de agendapropia_utils.regions'
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
            'article_regions'
        );
    }
}

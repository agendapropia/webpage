<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_articles')->create(
            'article_users',
            function (Blueprint $table) {
                $table->integerIncrements('id');
                $table->integer('article_id')->index();
                $table->integer('user_id')->index()->comment('Se relaciona con la tabla agendapropia_users.users');
                $table->integer('article_role_id')->index();
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
        Schema::connection('mysql_articles')->dropIfExists('article_users');
    }
}

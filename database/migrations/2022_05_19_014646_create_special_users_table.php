<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_articles')->create(
            'special_users',
            function (Blueprint $table) {
                $table->integerIncrements('id');
                $table->integer('special_id')->index();
                $table->integer('user_id')->index()->comment('Se relaciona con la tabla agendapropia_users.users');
                $table->integer('special_role_id')->index();
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
        Schema::connection('mysql_articles')->dropIfExists('special_users');
    }
}

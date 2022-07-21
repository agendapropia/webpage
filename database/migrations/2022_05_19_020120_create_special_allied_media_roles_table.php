<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialAlliedMediaRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_articles')->create(
            'special_allied_media_roles',
            function (Blueprint $table) {
                $table->integerIncrements('id');
                $table->string('name', 100);
                $table->string('label', 256);
                $table->string('icon', 256);
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
            'special_allied_media_roles'
        );
    }
}

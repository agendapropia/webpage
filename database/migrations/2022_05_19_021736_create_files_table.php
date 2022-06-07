<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_utils')->create('files', function (
            Blueprint $table
        ) {
            $table->integerIncrements('id');
            $table->integer('file_type_id')->index();
            $table->integer('user_id')->index();
            $table
                ->integer('creator_user_id')
                ->index()
                ->nullable();
            $table->string('name_tmp', 256);
            $table->string('name', 256);
            $table->text('description')->nullable();
            $table->string('author', 256)->nullable();
            $table->double('size');
            $table->integer('type');
            $table->string('ext', 50);
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
        Schema::connection('mysql_utils')->dropIfExists('files');
    }
}

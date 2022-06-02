<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_utils')->create('images', function (
            Blueprint $table
        ) {
            $table->integerIncrements('id');
            $table->integer('image_type_id')->index();
            $table->integer('user_id')->index();
            $table
                ->integer('creator_user_id')
                ->index()
                ->nullable();
            $table->string('source', 256);
            $table->string('name', 256);
            $table->text('description');
            $table->string('author', 256);
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
        Schema::connection('mysql_utils')->dropIfExists('images');
    }
}

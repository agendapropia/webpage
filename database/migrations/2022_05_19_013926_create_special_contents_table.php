<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_articules')->create(
            'special_contents',
            function (Blueprint $table) {
                $table->integerIncrements('id');
                $table
                    ->integer('special_id')
                    ->index()
                    ->comment(
                        'Relación con la tabla agendapropia_articules.specials'
                    );
                $table
                    ->integer('language_id')
                    ->index()
                    ->comment(
                        'Relación con la tabla agendapropia_utils.language'
                    );
                $table->boolean('status_id')->index();
                $table->string('title', 256);
                $table->string('subtitle', 256);
                $table->text('summary');
                $table->longText('content');
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
        Schema::connection('mysql_articules')->dropIfExists('special_contents');
    }
}

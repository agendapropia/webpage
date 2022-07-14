<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_articles')->create('specials', function (
            Blueprint $table
        ) {
            $table->integerIncrements('id');
            $table->string('slug', 150)->unique();
            $table
                ->integer('status_id')
                ->index()
                ->comment(
                    'Relación con la tabla agendapropia_articles.especial_status'
                );
            $table
                ->integer('template_id')
                ->index()
                ->comment(
                    'Relación con la tabla agendapropia_articles.specials_templates'
                );
            $table->string('name', 150);
            $table->date('publication_date');
            $table->boolean('hidden');
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
        Schema::connection('mysql_articles')->dropIfExists('specials');
    }
}

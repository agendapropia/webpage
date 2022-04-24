<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_history', function (Blueprint $table) {
            $table->id();
            $table
                ->bigInteger('use_id')
                ->index()
                ->comment('relates to field piddet-users.users.id');
            $table
                ->integer('term_id')
                ->index()
                ->comment('relates to field piddet-users.terms.id');
            $table->string('device');
            $table->string('ip');
            $table->string('os');
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
        Schema::dropIfExists('term_history');
    }
}

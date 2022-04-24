<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_stores')->create('store_schedules', function (
            Blueprint $table
        ) {
            $table->integerIncrements('id');
            $table->integer('store_id')->index();
            $table->integer('day_id')->index();
            $table->time('start_time');
            $table->time('end_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_stores')->dropIfExists('store_schedules');
    }
}

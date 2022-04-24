<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table
                ->id('user_id')
                ->unique()
                ->comment('relates to field piddet-users.users.id');
            $table->string('email')->unique();
            $table->integer('validated');
            $table->boolean('notifications_sms')->default(true);
            $table->boolean('notifications_push')->default(true);
            $table->boolean('notifications_email')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}

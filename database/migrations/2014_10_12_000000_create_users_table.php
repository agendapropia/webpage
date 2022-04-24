<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 20)->unique();
            $table
                ->boolean('status')
                ->index()
                ->default(true);
            $table->string('first_name');
            $table->string('last_name');
            $table
                ->boolean('gender_id')
                ->comment('relates to field piddet-users.user_genders.id');
            $table->string('phone_code', 10)->index();
            $table->string('phone_number', 30)->unique();
            $table->boolean('has_password')->default(false);
            $table->string('password');
            $table->string('location')->default('es');
            $table
                ->boolean('term_accepted_id')
                ->comment('relates to field piddet-users.terms.id');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

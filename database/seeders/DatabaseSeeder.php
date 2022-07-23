<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Users\UserProfile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserAdminitratorSeeder::class);
        \App\Models\Users\Term::factory(1)->create();
        $this->call(RolesSeeder::class);
        $this->call(UserGenderSeeder::class);
        $this->call(UtilsSeeder::class);
        $this->call(SpecialRolesSeeder::class);
        $this->call(SpecialSeeder::class);
        $this->call(ArticleRolesSeeder::class);
        $this->call(ArticleSeeder::class);
    }
}

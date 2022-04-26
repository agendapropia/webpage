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
        User::factory(10)
            ->has(UserProfile::factory()->count(1))
            ->create();
        \App\Models\Users\Term::factory(1)->create(); 
        \App\Models\Users\Country::factory(1)->create();
        \App\Models\Utils\City::factory(10)->create();
        
        $this->call(RolesSeeder::class);
        $this->call(UserGenderSeeder::class);
        $this->call(DaySeeder::class);
    }
}

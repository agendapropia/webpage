<?php

namespace Database\Seeders;

use App\Models\Users\UserGender;
use Illuminate\Database\Seeder;

class UserGenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserGender::create([
            'name' => 'Man',
            'icon' => 'man',
        ]);
        UserGender::create([
            'name' => 'Woman',
            'icon' => 'women',
        ]);
        UserGender::create([
            'name' => 'Other',
            'icon' => 'other',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Specials\SpecialRole;
use Illuminate\Database\Seeder;

class SpecialRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SpecialRole::create([
            'name' => 'Editor',
            'icon' => 'editor.png',
        ]);
        SpecialRole::create([
            'name' => 'Fotográfia',
            'icon' => 'photo.png',
        ]);
        SpecialRole::create([
            'name' => 'Apoyo',
            'icon' => 'apoyo.png',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Specials\SpecialRoles;
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
        SpecialRoles::create([
            'name' => 'Editor',
            'icon' => 'editor.png',
        ]);
        SpecialRoles::create([
            'name' => 'Fotográfia',
            'icon' => 'photo.png',
        ]);
        SpecialRoles::create([
            'name' => 'Apoyo',
            'icon' => 'apoyo.png',
        ]);
    }
}

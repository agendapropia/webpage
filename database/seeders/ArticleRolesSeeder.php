<?php

namespace Database\Seeders;

use App\Models\Articles\ArticleRole;
use Illuminate\Database\Seeder;

class ArticleRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArticleRole::create([
            'name' => 'Editor',
            'icon' => 'editor.png',
        ]);
        ArticleRole::create([
            'name' => 'Fotográfia',
            'icon' => 'photo.png',
        ]);
        ArticleRole::create([
            'name' => 'Apoyo',
            'icon' => 'apoyo.png',
        ]);
    }
}

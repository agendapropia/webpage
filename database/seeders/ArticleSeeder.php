<?php

namespace Database\Seeders;

use App\Models\Articles\Article;
use App\Models\Articles\ArticleCountry;
use App\Models\Articles\ArticleRegion;
use App\Models\Articles\ArticleStatus;
use App\Models\Articles\ArticleTag;
use App\Models\Articles\ArticleType;
use App\Models\Articles\ArticleUser;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArticleStatus::insert([
            [
                'id' => 4,
                'name' => 'Inactivo',
                'icon' => 'inactive.png',
                'label' => 'badge-warning',
            ],
            [
                'id' => 1,
                'name' => 'Publicado',
                'icon' => 'active.png',
                'label' => 'badge-success',
            ],
            [
                'id' => 2,
                'name' => 'Editando',
                'icon' => 'schedule.png',
                'label' => 'badge-info',
            ],
            [
                'id' => 3,
                'name' => 'Revisión',
                'icon' => 'review.png',
                'label' => 'badge-primary',
            ],
        ]);

        ArticleType::insert([
            [
                'id' => 1,
                'name' => 'Historias',
                'icon' => 'history.png',
            ],
            [
                'id' => 2,
                'name' => 'Nota Periodistica',
                'icon' => 'note.png',
            ],
            [
                'id' => 3,
                'name' => 'Investigación',
                'icon' => 'spike.png',
            ],
        ]);

        $day = ArticleStatus::find(4);
        $day->id = 0;
        $day->save();
    }
}

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
                'label' => 'badge-dange',
            ],
            [
                'id' => 1,
                'name' => 'Activo',
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
                'name' => 'Programado',
                'icon' => 'schedule.png',
                'label' => 'badge-warning',
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

        $article = Article::create([
            'name' => 'Articulo de prueba',
            'slug' => 'article-de-prueba',
            'status_id' => 3,
            'article_type_id' => 1,
            'special_id' => 1,
            'publication_date' => '2022-05-10',
            'number_views' => 0,
        ]);

        ArticleUser::create([
            'article_id' => $article->id,
            'user_id' => 1,
            'article_role_id' => 1,
        ]);

        ArticleCountry::create([
            'article_id' => $article->id,
            'country_id' => 1,
        ]);

        ArticleRegion::create([
            'article_id' => $article->id,
            'region_id' => 1,
        ]);

        ArticleTag::create([
            'article_id' => $article->id,
            'tag_id' => 1,
        ]);
    }
}

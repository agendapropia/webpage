<?php

namespace Database\Seeders;

use App\Models\Specials\AlliedMedia;
use App\Models\Specials\Special;
use App\Models\Specials\SpecialAlliedMedia;
use App\Models\Specials\SpecialCountry;
use App\Models\Specials\SpecialStatus;
use App\Models\Specials\SpecialTag;
use App\Models\Specials\SpecialUser;
use Illuminate\Database\Seeder;

class SpecialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SpecialStatus::insert([
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

        $day = SpecialStatus::find(4);
        $day->id = 0;
        $day->save();

        AlliedMedia::insert([
            [
                'name' => 'Medium',
                'image' => null,
                'url' => 'https://medium.com',
            ],
            [
                'name' => 'newyorktime',
                'image' => null,
                'url' => 'https://newyorktime.com',
            ],
            [
                'name' => 'BCC',
                'image' => null,
                'url' => 'https://bcc.com',
            ],
        ]);

        Special::create([
            'name' => 'No aplica',
            'slug' => 'no-aplica-especial',
            'status_id' => 1,
            'template_id' => 1,
            'publication_date' => '2022-05-10',
            'hidden' => true,
            'number_views' => 0,
        ]);
    }
}

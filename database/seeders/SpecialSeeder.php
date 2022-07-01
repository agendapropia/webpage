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

        $special = Special::create([
            'name' => 'Especial de prueba',
            'slug' => 'especial-de-prueba',
            'status_id' => 3,
            'template_id' => 1,
            'publication_date' => '2022-05-10',
            'hidden' => true,
            'number_views' => 0,
        ]);

        SpecialUser::create([
            'special_id' => $special->id,
            'user_id' => 1,
            'special_role_id' => 1,
        ]);

        SpecialCountry::create([
            'special_id' => $special->id,
            'country_id' => 1,
        ]);

        SpecialAlliedMedia::create([
            'special_id' => $special->id,
            'allied_media_id' => 1000,
        ]);

        SpecialTag::create([
            'special_id' => $special->id,
            'tag_id' => 1,
        ]);
    }
}

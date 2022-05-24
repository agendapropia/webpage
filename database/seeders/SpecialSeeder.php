<?php

namespace Database\Seeders;

use App\Models\Specials\AlliedMedia;
use App\Models\Specials\Special;
use App\Models\Specials\SpecialAlliedMedia;
use App\Models\Specials\SpecialCountry;
use App\Models\Specials\SpecialRoles;
use App\Models\Specials\Specials;
use App\Models\Specials\SpecialStatus;
use App\Models\Specials\SpecialTag;
use App\Models\Specials\SpecialTags;
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
                'label' => 'badge-info',
            ],
        ]);

        $day = SpecialStatus::find(4);
        $day->id = 0;
        $day->save();

        AlliedMedia::insert([
            [
                'name' => 'Medium',
                'icon' => 'medium.jpg',
                'url' => 'https://medium.com',
            ],
            [
                'name' => 'newyorktime',
                'icon' => 'newyorktime.png',
                'url' => 'https://newyorktime.com',
            ],
        ]);

        AlliedMedia::insert([
            [
                'name' => 'Medium',
                'icon' => 'medium.jpg',
                'url' => 'https://medium.com',
            ],
            [
                'name' => 'newyorktime',
                'icon' => 'newyorktime.png',
                'url' => 'https://newyorktime.com',
            ],
        ]);

        $special = Special::create([
            'name' => 'Especial de prueba',
            'slug' => 'espacial-de-prueba',
            'status_id' => 1,
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
            'allied_media_id' => 1,
        ]);

        SpecialTag::create([
            'special_id' => $special->id,
            'tag_id' => 1,
        ]);
    }
}

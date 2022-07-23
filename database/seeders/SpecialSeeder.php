<?php

namespace Database\Seeders;

use App\Models\Specials\AlliedMedia;
use App\Models\Specials\Special;
use App\Models\Specials\SpecialAlliedMedia;
use App\Models\Specials\SpecialAlliedMediaRole;
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

        SpecialAlliedMediaRole::insert([
            [
                'id' => 4,
                'name' => 'Proyecto',
                'label' => 'Un proyecto de',
                'icon' => 'project.png',
            ],
            [
                'id' => 1,
                'name' => 'Medios Aliados',
                'label' => 'Medios Aliados',
                'icon' => 'media.png',
            ],
            [
                'id' => 2,
                'name' => 'Apoyo',
                'label' => 'Con el apoyo de',
                'icon' => 'apoyo.png',
            ],
        ]);

        $day = SpecialStatus::find(4);
        $day->id = 0;
        $day->save();
    }
}

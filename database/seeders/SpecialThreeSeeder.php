<?php

namespace Database\Seeders;

use App\Models\Specials\Special;
use App\Models\Specials\SpecialAlliedMedia;
use App\Models\Specials\SpecialCountry;
use App\Models\Specials\SpecialTag;
use App\Models\Specials\SpecialUser;
use Illuminate\Database\Seeder;

class SpecialThreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $special = Special::create([
            'name' => 'Especial del Cauca',
            'slug' => 'especial-de-cauca',
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

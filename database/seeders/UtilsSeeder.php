<?php

namespace Database\Seeders;

use App\Models\Specials\Template;
use App\Models\Users\Country;
use App\Models\Utils\Day;
use App\Models\Utils\FileType;
use App\Models\Utils\Language;
use Illuminate\Database\Seeder;

class UtilsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->days();
        $this->fileTypes();
        $this->languages();
        $this->countries();
        $this->templates();
    }

    private function countries()
    {
        Country::create([
            'status' => 1,
            'name' => 'Colombia',
            'icon' => 'country-code.png',
            'country_code' => 57,
            'timezone' => 'America/Bogota',
        ]);

        Country::create([
            'status' => 2,
            'name' => 'Mexico',
            'icon' => 'country.png',
            'country_code' => 52,
            'timezone' => 'America/Bogota',
        ]);

        Country::create([
            'status' => 3,
            'name' => 'Brasil',
            'icon' => 'country.png',
            'country_code' => 56,
            'timezone' => 'America/Bogota',
        ]);
    }

    private function days()
    {
        Day::create([
            'id' => 1,
            'name' => 'Lunes',
        ]);
        Day::create([
            'id' => 2,
            'name' => 'Martes',
        ]);
        Day::create([
            'id' => 3,
            'name' => 'Miercoles',
        ]);
        Day::create([
            'id' => 4,
            'name' => 'Jueves',
        ]);
        Day::create([
            'id' => 5,
            'name' => 'Viernes',
        ]);
        Day::create([
            'id' => 6,
            'name' => 'Sábado',
        ]);
        Day::create([
            'id' => 7,
            'name' => 'Festivos',
        ]);
        Day::create([
            'id' => 8,
            'name' => 'Domingo',
        ]);

        $day = Day::find(8);
        $day->id = 0;
        $day->save();
    }

    private function fileTypes()
    {
        FileType::create([
            'name' => 'Imagen PNG',
            'type' => 'IMAGE',
            'icon' => 'image_png.png',
            'extension' => '.png',
        ]);
        FileType::create([
            'name' => 'Imagen JPG',
            'type' => 'IMAGE',
            'icon' => 'image_jpg.png',
            'extension' => '.jpg',
        ]);
        FileType::create([
            'name' => 'Imagen JPEG',
            'type' => 'IMAGE',
            'icon' => 'image_jpeg.png',
            'extension' => '.jpeg',
        ]);
        FileType::create([
            'name' => 'Imagen gif',
            'type' => 'IMAGE',
            'icon' => 'image_gif.png',
            'extension' => '.gif',
        ]);
    }

    private function languages()
    {
        Language::create([
            'name' => 'Español',
            'icon' => 'es.png',
        ]);
        Language::create([
            'name' => 'Ingles',
            'icon' => 'en.png',
        ]);
        Language::create([
            'name' => 'Propia',
            'icon' => 'pr.png',
        ]);
    }

    private function templates()
    {
        Template::create([
            'name' => 'Base',
            'slug' => 'template-base',
        ]);
        Template::create([
            'name' => 'Pueblos andinos',
            'slug' => 'template-pueblos-andinos',
        ]);
        Template::create([
            'name' => 'Tierras fragmentadas',
            'slug' => 'template-tierras-frag',
        ]);
    }
}

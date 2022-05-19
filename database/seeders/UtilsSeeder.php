<?php

namespace Database\Seeders;

use App\Models\Utils\Day;
use App\Models\Utils\ImageType;
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
        $this->imageTypes();
        $this->languages();
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

    private function imageTypes()
    {
        ImageType::create([
            'name' => 'Imagen PNG',
            'type' => 'IMAGE',
            'icon' => 'image_png.png',
            'extension' => '.png',
        ]);
        ImageType::create([
            'name' => 'Imagen JPG',
            'type' => 'IMAGE',
            'icon' => 'image_jpg.png',
            'extension' => '.jpg',
        ]);
        ImageType::create([
            'name' => 'Imagen JPEG',
            'type' => 'IMAGE',
            'icon' => 'image_jpeg.png',
            'extension' => '.jpeg',
        ]);
        ImageType::create([
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
}

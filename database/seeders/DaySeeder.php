<?php

namespace Database\Seeders;

use App\Models\Utils\Day;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
}

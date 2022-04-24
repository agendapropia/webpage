<?php

namespace Database\Seeders;

use App\Models\Stores\StoreStatus;
use Illuminate\Database\Seeder;

class StoreStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StoreStatus::create([
            'name' => 'Activo',
        ]);
        StoreStatus::create([
            'name' => 'Inactiva',
        ]);
        StoreStatus::create([
            'name' => 'Cierre Temporal',
        ]);
    }
}

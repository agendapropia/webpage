<?php

namespace Database\Seeders;

use App\Models\Stores\StoreType;
use Illuminate\Database\Seeder;

class StoreTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StoreType::create([
            'status' => 1,
            'uuid' => 'restaurantes',
            'name' => 'Restaurantes',
            'name_short' => 'Rest',
            'details' => 'Restaurantes del sector',
            'icon' => 'restaurant.png',
            'image' => 'restaurant.png',
        ]);
        StoreType::create([
            'status' => 1,
            'uuid' => 'farmacias',
            'name' => 'Farmacias',
            'name_short' => 'far',
            'details' => 'Farmacias del sector',
            'icon' => 'farmac.png',
            'image' => 'farmac.png',
        ]);
        StoreType::create([
            'status' => 1,
            'uuid' => 'supermercados',
            'name' => 'Supermercados',
            'name_short' => 'Super',
            'details' => 'Supermercados del sector',
            'icon' => 'supermarket.png',
            'image' => 'supermarket.png',
        ]);
    }
}

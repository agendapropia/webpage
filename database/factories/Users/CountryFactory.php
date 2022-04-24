<?php

namespace Database\Factories\Users;

use App\Models\Users\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => 1,
            'name' => 'Colombia',
            'icon' => 'country-code.png',
            'country_code' => 57,
            'timezone' => 'America/Bogota',
        ];
    }
}

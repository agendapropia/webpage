<?php

namespace Database\Factories\Utils;

use App\Models\Utils\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Region::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'image' => $this->faker->url(),
            'icon' => $this->faker->url(),
            'country_id' => 1,
        ];
    }
}

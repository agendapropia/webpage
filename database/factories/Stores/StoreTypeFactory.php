<?php

namespace Database\Factories\Stores;

use App\Models\Stores\StoreType;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoreType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => 1,
            'uuid' => $this->faker->randomNumber(9),
            'name' => $this->faker->name(),
            'name_short' => $this->faker->name(),
            'details' => $this->faker->text(150),
            'icon' => $this->faker->image(),
            'image' => $this->faker->image(),
        ];
    }
}

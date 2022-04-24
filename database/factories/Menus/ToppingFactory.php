<?php

namespace Database\Factories\Menus;

use App\Models\Menus\Topping;
use Illuminate\Database\Eloquent\Factories\Factory;

class ToppingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Topping::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => 1,
            'store_id' => 1,
            'name' => $this->faker->name(),
            'description' => $this->faker->realText(200),
            'image' => $this->faker->randomElement([
                'image.png',
                'lechuga.jpg',
                'picogallo.png',
                'salsa.jpg',
            ]),
        ];
    }
}

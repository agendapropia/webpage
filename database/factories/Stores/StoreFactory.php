<?php

namespace Database\Factories\Stores;

use App\Models\Stores\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'store_type_id' => $this->faker->randomElement([1, 2, 3]),
            'city_id' => $this->faker->randomElement([1, 2, 3]),
            'store_status_id' => 1,
            'uuid' => $this->faker->randomNumber(9),
            'name' => $this->faker->name(),
            'name_short' => substr($this->faker->name(), 0, 15),
            'details' => $this->faker->text(150),
            'address' => $this->faker->name(),
            'phone_code' => $this->faker->randomElement([57]),
            'phone_number' => $this->faker->randomFloat(
                0,
                3100000000,
                3300000000
            ),
            'latitude' => $this->faker->randomFloat(5, 1, 2),
            'longitude' => $this->faker->randomFloat(5, 1, 2),
            'icon' => $this->faker->image(),
            'image' => $this->faker->image(),
        ];
    }
}

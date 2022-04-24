<?php

namespace Database\Factories\Stores;

use App\Models\Stores\StoreUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoreUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => 1,
            'store_id' => $this->faker->randomNumber(1) + 1,
            'user_id' => $this->faker->randomNumber(1) + 1,
        ];
    }
}

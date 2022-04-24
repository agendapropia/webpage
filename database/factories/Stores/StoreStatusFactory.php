<?php

namespace Database\Factories\Stores;

use App\Models\Stores\StoreStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoreStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}

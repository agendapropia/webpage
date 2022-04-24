<?php

namespace Database\Factories\Stores;

use App\Models\Stores\StoreSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoreSchedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'store_id' => $this->faker->randomElement([1, 2]),
            'day_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 0]),
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
        ];
    }
}

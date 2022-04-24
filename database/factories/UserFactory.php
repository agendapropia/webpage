<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => rand(10000, 999999),
            'status' => true,
            'term_accepted_id' => 1,
            'gender_id' => rand(1, 2),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone_code' => $this->faker->randomElement([57]),
            'phone_number' => $this->faker->randomFloat(
                0,
                3100000000,
                3300000000
            ),
            'has_password' => true,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }
}

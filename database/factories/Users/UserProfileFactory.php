<?php

namespace Database\Factories\Users;

use App\Models\Users\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'validated' => true,
            'notifications_sms' => true,
            'notifications_push' => true,
            'notifications_email' => true,
        ];
    }
}

<?php

namespace Database\Factories\Users;

use App\Models\Users\Term;
use Illuminate\Database\Eloquent\Factories\Factory;

class TermFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Term::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => 1,
            'version' => '1.0',
            'name' => 'versión base',
            'content' => $this->faker->realText(200)
        ];
    }
}

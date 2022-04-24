<?php

namespace Database\Factories\Menus;

use App\Models\Menus\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 1,
            'status' => 1,
            'name' => "Hamburguesas",
            'icon' => "image.png",
            'image' => 'image.png',
        ];
    }
}

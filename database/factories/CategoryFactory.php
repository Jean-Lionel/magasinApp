<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Stocke;
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
     title

     title
description

     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->text,
            'stock_id' => Stocke::all()->random()->id
        ];
    }
}

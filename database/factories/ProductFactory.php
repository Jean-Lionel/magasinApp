<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *name
code_product
name
quantite
price
date_expiration

     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'code_product' => Str::random(10),
            'price' => $this->faker->buildingNumber,
            'quantite' => $this->faker->randomDigitNot(20),
            'date_expiration' => $this->faker->date,
            'category_id' => Category::all()->random()->id
        ];
    }
}

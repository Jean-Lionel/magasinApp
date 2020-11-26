<?php

namespace Database\Factories;

use App\Models\Stocke;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stocke::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        

        return [
            //
            'name' => $this->faker->firstName,
            'description' => $this->faker->text,
        ];
    }
}

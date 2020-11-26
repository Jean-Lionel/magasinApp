<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *name
telephone
addresse
description
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'telephone' => $this->faker->phoneNumber,
            'addresse' => $this->faker->address,
            'description' => $this->faker->text,

        ];
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\Client::factory(15)->create();
        // \App\Models\Stocke::factory(10)->create();
        // \App\Models\Category::factory(10)->create();
        // \App\Models\Product::factory(10)->create();


        \App\Models\Role::create(['name' => 'ADMINISTRATEUR']);
        \App\Models\Role::create(['name' => 'CONTROLLEUR']);
        \App\Models\Role::create(['name' => 'COMPTABLE']);
        \App\Models\Role::create(['name' => 'VENTE']);
        \App\Models\Role::create(['name' => 'ENTRE DES PRODUITS EN STOCK']);
    }
}

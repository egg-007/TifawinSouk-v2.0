<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categorie;

class CategorieFactory extends Factory
{
    protected $model = Categorie::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(8),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

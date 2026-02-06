<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categorie;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categorie>
 */
class CategorieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Categorie::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->randomElement([
                'Électronique',
                'Informatique',
                'Vêtements',
                'Alimentation',
                'Maison et Jardin',
                'Sports et Loisirs',
                'Beauté et Santé',
                'Livres et Médias',
                'Automobile',
            ]),
        ];
    }
}

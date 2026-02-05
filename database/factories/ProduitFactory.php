<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produit;
use App\Models\Fornisseur;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produit::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reference' => 'PROD-' . $this->faker->unique()->numerify('#####'),
            'nom' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(10),
            'prix' => $this->faker->randomFloat(2, 10, 1000),
            'quantite_stock' => $this->faker->numberBetween(1, 500),
            'image' => $this->faker->imageUrl(400, 400, 'products'),
            'fournisseur_id' => Fornisseur::inRandomOrder()->first()->id,
            'categorie_id' => \App\Models\Categorie::inRandomOrder()->first()->id,
            'statut' => $this->faker->randomElement(['actif', 'inactif']),
        ];
    }
}

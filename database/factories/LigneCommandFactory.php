<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LigneCommand;
use App\Models\Command;
use App\Models\Produit;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LigneCommand>
 */
class LigneCommandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LigneCommand::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantite = $this->faker->numberBetween(1, 10);
        $prixUnitaire = $this->faker->randomFloat(2, 10, 500);
        
        return [
            'commande_id' => Command::factory(),
            'produit_id' => Produit::factory(),
            'quantite' => $quantite,
            'prix_unitaire' => $prixUnitaire,
            'prix_total' => $quantite * $prixUnitaire,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Command;
use App\Models\Utilisateur;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Command>
 */
class CommandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Command::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reference' => 'CMD-' . $this->faker->unique()->numerify('#####'),
            'date_commande' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'montant_total' => $this->faker->randomFloat(2, 50, 5000),
            'statut' => $this->faker->randomElement(['en_attente', 'confirmee', 'expediee', 'livree', 'annulee']),
            'utilisateur_id' => Utilisateur::factory(),
            'notes' => $this->faker->sentence(5),
        ];
    }
}

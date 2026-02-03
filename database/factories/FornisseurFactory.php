<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Fornisseur;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fornisseur>
 */
class FornisseurFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fornisseur::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->company(),
            'contact_personne' => $this->faker->name(),
            'email' => $this->faker->unique()->companyEmail(),
            'telephone' => $this->faker->phoneNumber(),
            'adresse' => $this->faker->streetAddress(),
            'ville' => $this->faker->city(),
            'pays' => $this->faker->country(),
            'statut' => $this->faker->randomElement(['actif', 'inactif']),
        ];
    }
}

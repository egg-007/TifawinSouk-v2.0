<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fornisseur;

class FornisseurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fornisseur::factory()->count(15)->create();
        $this->command->info('Fournisseurs créés avec succès!');
    }
}

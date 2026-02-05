<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LigneCommand;

class LigneCommandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LigneCommand::factory()->count(150)->create();
        $this->command->info('Lignes de commande créées avec succès!');
    }
}

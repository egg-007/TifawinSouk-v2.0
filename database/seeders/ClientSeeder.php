<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Utilisateur;
use App\Models\Role;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientRole = Role::where('nom', 'client')->first();
        
        Utilisateur::factory()->count(10)->create([
            'role_id' => $clientRole->id,
        ]);

        $this->command->info('Clients créés avec succès!');
    }
}

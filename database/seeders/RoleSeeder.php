<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'nom' => 'admin',
                'description' => 'Administrateur du système avec accès complet',
            ],
            [
                'nom' => 'client',
                'description' => 'Client du système',
            ],
            [
                'nom' => 'fournisseur',
                'description' => 'Fournisseur du système',
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['nom' => $role['nom']],
                $role
            );
        }

        $this->command->info('Rôles créés avec succès!');
    }
}

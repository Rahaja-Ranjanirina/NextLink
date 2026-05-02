<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vérifie si le superadmin existe déjà
        if (!User::where('email', 'admin@nextlink.com')->exists()) {

            User::create([
                'name'     => 'Admin',
                'prenom'   => 'Super',
                'email'    => 'admin@nextlink.com',
                'age'      => 30,
                'role'     => 'superadmin',
                'password' => Hash::make('12345678'),
            ]);

            $this->command->info('✅ SuperAdmin créé avec succès !');

        } else {
            $this->command->warn('⚠️ SuperAdmin existe déjà.');
        }
    }
}
<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->state([
                'email' => 'administrador@laraveleando.com'
            ])
            ->administrator()
            ->create();

        User::factory()
            ->state([
                'email' => 'profesor@laraveleando.com'
            ])
            ->teacher()
            ->create();

        User::factory()
            ->state([
                'email' => 'estudiante@laraveleando.com'
            ])
            ->student()
            ->create();
    }
}

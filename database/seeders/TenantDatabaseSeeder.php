<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Tenant\CatCid10Seeder;
use Database\Seeders\Tenant\EspecialidadeTableSeeder;
use Database\Seeders\Tenant\ModalidadeSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EspecialidadeTableSeeder::class,
            ModalidadeSeeder::class,
            CatCid10Seeder::class,
        ]);
        // demo user
        \App\Models\User::create([
            'username' => 'demo',
            'password' => Hash::make('demo'),
        ]);
    }
}

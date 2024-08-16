<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\SuratKerja;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // RoleSeeder::class,
            // UserSeeder::class,
            // ParpolSeeder::class,
            // JenisPelanggaranSeeder::class,
            // SuratKerjaSeeder::class,
            PelanggaranSeeder::class,
            PelanggaranImagesSeeder::class,
            // IndoRegionSeeder::class,
        ]);
    }
}

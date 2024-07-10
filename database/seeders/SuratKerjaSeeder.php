<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuratKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suratKerjas = [
            [
                'nomor_surat_kerja' => 'SK-001',
                'assign_by' => 2,
                'assign_to' => 3,
            ],
            [
                'nomor_surat_kerja' => 'SK-002',
                'assign_by' => 2,
                'assign_to' => 4,
            ],
        ];

        foreach ($suratKerjas as $suratKerja) {
            \App\Models\SuratKerja::create($suratKerja);
        }
    }
}

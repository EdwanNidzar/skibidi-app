<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPelanggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisPelanggaran = [
            'Pelanggaran Administrasi',
            'Pelanggaran Kode Etik',
            'Pelanggaran Pidana Pemilu',
            'Pelanggaran Hukum Lain',
        ];

        foreach ($jenisPelanggaran as $jenis) {
            \App\Models\JenisPelanggaran::create([
                'jenis_pelanggaran' => $jenis,
            ]);
        }
    }
}

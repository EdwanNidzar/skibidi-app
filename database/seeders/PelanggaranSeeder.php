<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelanggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelanggaran = [
            [
                'parpol_id' => 1,
                'jenis_pelanggaran_id' => 1,
                'status_peserta_pemilu' => 'DPRD Provinsi',
                'nama_bacaleg' => 'Budi',
                'dapil' => 'Kalimantan Selatan 1',
                'tanggal_input' => '2024-07-10',
                'keterangan' => 'Budi melakukan pelanggaran saat kampanye',
                'surat_kerja_id' => 1,
                'pelapor_id' => 3,
            ],
            [
                'parpol_id' => 1,
                'jenis_pelanggaran_id' => 1,
                'status_peserta_pemilu' => 'DPRD Provinsi',
                'nama_bacaleg' => 'Wati',
                'dapil' => 'Kalimantan Selatan 1',
                'tanggal_input' => '2024-07-10',
                'keterangan' => 'Wati melakukan pelanggaran saat kampanye dan membagikan uang',
                'surat_kerja_id' => 2,
                'pelapor_id' => 4,
            ],
        ];

        foreach ($pelanggaran as $data) {
            \App\Models\Pelanggaran::create($data);
        }
    }
}

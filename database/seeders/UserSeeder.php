<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinsi = User::create([
            'name' => 'Bawaslu Provinsi',
            'email' => 'provinsi@gmail.com',
            'password' => bcrypt('provinsi1234'),
        ]);
        $provinsi->assignRole('bawaslu-provinsi');

        $kota = User::create([
            'name' => 'Bawaslu Kota/Kabupaten',
            'email' => 'nidzaredwan@gmail.com',
            'password' => bcrypt('kota1234'),
        ]);
        $kota->assignRole('bawaslu-kabupaten-kota');

        $kecamatan = User::create([
            'name' => 'Panwaslu Kecamatan',
            'email' => 'panwascam@gmail.com',
            'password' => bcrypt('panwascam1234'),
        ]);
        $kecamatan->assignRole('panwaslu-kecamatan');

        $edwan = User::create([
            'name' => 'Edwan Nidzar',
            'email' => 'edwannidzar@gmail.com',
            'password' => bcrypt('qwerty1234'),
        ]);
        $edwan->assignRole('panwaslu-kecamatan');
    }
}

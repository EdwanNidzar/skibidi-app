<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'bawaslu-provinsi']);
        Role::create(['name' => 'bawaslu-kabupaten-kota']);
        Role::create(['name' => 'panwaslu-kecamatan']);
    }
}

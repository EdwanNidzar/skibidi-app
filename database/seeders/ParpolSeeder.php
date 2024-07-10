<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ParpolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        $parpols = [
            [
                'parpol_number' => '1',
                'parpol_name' => 'Partai Kebangkitan Bangsa (PKB)',
            ],
            [
                'parpol_number' => '2',
                'parpol_name' => 'Partai Gerakan Indonesia Raya (Gerindra)',
            ],
            [
                'parpol_number' => '3',
                'parpol_name' => 'Partai Demokrasi Indonesia Perjuangan (PDI Perjuangan)',
            ],
            [
                'parpol_number' => '4',
                'parpol_name' => 'Partai Golongan Karya (Golkar)',
            ]
        ];

        foreach ($parpols as $parpol) {
            // Generate a fake image
            $imagePath = $faker->image(storage_path('app/public/parpols'), 480, 480, null, false);
            
            // Add the generated image path to the parpol array
            $parpol['parpol_picture'] = $imagePath;

            // Create the parpol record
            \App\Models\Parpol::create($parpol);
        }
    }
}

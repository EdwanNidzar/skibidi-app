<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Pelanggaran;
use App\Models\PelanggaranImages;

class PelanggaranImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Fetch existing pelanggaran_ids from the database
        $pelanggaranIds = Pelanggaran::pluck('id')->toArray();

        foreach ($pelanggaranIds as $pelanggaranId) {
            $numberOfImages = rand(1, 5); // Determine a random number of images for each pelanggaran_id

            for ($i = 0; $i < $numberOfImages; $i++) {
                // Generate a fake image
                $imagePath = $faker->image(storage_path('app/public/pelanggarans'), 480, 480, null, false);

                // Create data array
                $data = [
                    'pelanggaran_id' => $pelanggaranId,
                    'image' => $imagePath,
                ];

                // Save data to the database
                PelanggaranImages::create($data);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Horse;

class HorseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Horse::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $owner = \App\Models\User::first();
        if (!$owner) {
            $owner = \App\Models\User::factory()->create();
        }

        // We have 10 images available (1.webp to 10.webp)
        for ($i = 1; $i <= 8; $i++) {
            $horseData = [
                'name' => ['ar' => 'الحصان العربي ' . $i, 'en' => 'Arabian Horse ' . $i],
                'owner_id' => $owner->id,
                'age' => rand(3, 10),
                'breed' => 'عربي اصيل',
                'color' => 'بني',
                'price' => rand(5000, 50000),
                'is_for_sale' => true,
                'is_active' => true,
                'is_featured' => true,
                'gender' => ($i % 2 == 0) ? 'mare' : 'stallion', // Adjusted enum values if needed, checking resource it says male/female
            ];

            // Adjust gender to match resource options 'male', 'female'
            $horseData['gender'] = ($i % 2 == 0) ? 'female' : 'male';

            // Optionally assign stable
            $stable = \App\Models\Stable::inRandomOrder()->first();
            if ($stable) {
                $horseData['stable_id'] = $stable->id;
            }

            $horse = Horse::create($horseData);

            $imagePath = public_path('images/horses/' . $i . '.webp');
            if (file_exists($imagePath)) {
                try {
                    $horse->addMedia($imagePath)
                        ->preservingOriginal()
                        ->toMediaCollection('main_image');

                    // Add same image to gallery for demo
                    $horse->addMedia($imagePath)
                        ->preservingOriginal()
                        ->toMediaCollection('gallery');
                } catch (\Throwable $e) {
                    // Skip large files or errors
                }
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stable;

class StableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stable::truncate();

        $owner = \App\Models\User::first();
        if (!$owner) {
            // Create one if not exists (fallback)
            $owner = \App\Models\User::factory()->create();
        }

        for ($i = 1; $i <= 6; $i++) {
            $stable = Stable::create([
                'owner_id' => $owner->id,
                'name' => ['ar' => 'اسطبل ' . $i, 'en' => 'Stable ' . $i],
                'description' => ['ar' => 'وصف للاسطبل رقم ' . $i, 'en' => 'Description for stable ' . $i],
                'is_active' => true,
                'is_featured' => true,
                'latitude' => 24.7136,
                'longitude' => 46.6753,
            ]);

            // Assuming a placeholder for stable images if specific ones adhere to index.html pattern
            // Using service images as placeholders for now if stable specific ones don't exist
            if (file_exists(public_path('images/services/1.webp'))) {
                $stable->addMedia(public_path('images/services/1.webp'))
                    ->preservingOriginal()
                    ->toMediaCollection('main_image');
            }
        }
    }
}

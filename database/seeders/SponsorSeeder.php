<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sponsor;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sponsor::truncate();

        for ($i = 1; $i <= 6; $i++) {
            $sponsor = Sponsor::create([
                'name' => 'Sponsor ' . $i,
                'website' => '#',
                'logo' => 'brands/' . $i . '.webp', // Keep for fallback/validation
                'is_active' => true,
                'order' => $i,
            ]);

            $imagePath = public_path('images/brands/' . $i . '.webp');

            if (file_exists($imagePath)) {
                $sponsor->addMedia($imagePath)
                    ->preservingOriginal()
                    ->toMediaCollection('logo');
            }
        }
    }
}

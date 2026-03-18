<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $this->call([
            RolesAndPermissionsSeeder::class,
            CategoriesSeeder::class,
            BlogSeeder::class,
            BannerSeeder::class,
            SliderSeeder::class,
            StableSeeder::class,
            HorseSeeder::class,
            ProductSeeder::class,
            SponsorSeeder::class,
            HorseReviewSeeder::class,
            PhotographySeeder::class,
            InformationPageSeeder::class,
            EquestrianSportSeeder::class,
            CollaborationSeeder::class,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}

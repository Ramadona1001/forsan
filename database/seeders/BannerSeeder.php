<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::truncate();

        $banners = [
            [
                'title' => ['ar' => 'بنر علوي 1', 'en' => 'Top Banner 1'],
                'position' => 'top',
                'sort_order' => 1,
                'image' => 'banner1.svg'
            ],
            [
                'title' => ['ar' => 'بنر علوي 2', 'en' => 'Top Banner 2'],
                'position' => 'top',
                'sort_order' => 2,
                'image' => 'banner2.svg'
            ],
            [
                'title' => ['ar' => 'بنر وسطي', 'en' => 'Middle Banner'],
                'position' => 'middle',
                'sort_order' => 1,
                'image' => 'banner3.svg'
            ],
        ];

        foreach ($banners as $data) {
            $image = $data['image'];
            unset($data['image']);

            $banner = Banner::create($data);

            if (file_exists(public_path('images/' . $image))) {
                $banner->addMedia(public_path('images/' . $image))
                    ->preservingOriginal()
                    ->toMediaCollection('image');
            }
        }
    }
}

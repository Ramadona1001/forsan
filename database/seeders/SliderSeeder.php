<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Slider::truncate();

        $sliders = [
            [
                'title' => ['ar' => 'عنوان السلايدر 1', 'en' => 'Slider Title 1'],
                'link' => '#',
                'image' => 'slider.svg'
            ],
            [
                'title' => ['ar' => 'عنوان السلايدر 2', 'en' => 'Slider Title 2'],
                'link' => '#',
                'image' => 'slider.svg'
            ],
            [
                'title' => ['ar' => 'عنوان السلايدر 3', 'en' => 'Slider Title 3'],
                'link' => '#',
                'image' => 'slider.svg'
            ],
            [
                'title' => ['ar' => 'عنوان السلايدر 4', 'en' => 'Slider Title 4'],
                'link' => '#',
                'image' => 'slider.svg'
            ],
        ];

        foreach ($sliders as $index => $data) {
            $image = $data['image'];
            // Do not unset image, it is required in the database schema

            $data['order'] = $index + 1;
            $data['is_active'] = true;

            $slider = Slider::create($data);

            if (file_exists(public_path('images/' . $image))) {
                $slider->addMedia(public_path('images/' . $image))
                    ->preservingOriginal()
                    ->toMediaCollection('image');
            }
        }
    }
}

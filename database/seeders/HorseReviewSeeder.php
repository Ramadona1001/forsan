<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Service;
use App\Models\ServiceTab;
use App\Models\ServicePackage;
use Illuminate\Database\Seeder;

class HorseReviewSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Clear existing data
        \App\Models\HorseReview::truncate();

        // 2. Create the main Horse Review Record matches HTML template
        $review = \App\Models\HorseReview::create([
            'title' => [
                'ar' => 'استعراض الخيول العربية الأصيلة',
                'en' => 'Arabian Purebred Horse Show'
            ],
            'description' => [
                'ar' => 'لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواسأيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايتنيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نو برفوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايتنيولا باراياتيور. أيكسسيبتيور',
                'en' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
            ],
            'price' => 1000.00,
            'trainer_info' => [
                'ar' => 'تعتبر تنظيم وإدارة الفعاليات الخاصة بالفروسية من المجالات الحيوية التي تجمع بين الشغف والاحترافية. تشمل هذه الفعاليات مسابقات متنوعة، مثل سباقات القفز وسباقات القدرة، التي تتطلب تخطيطًا دقيقًا وإعدادًا مسبقًا. بالإضافة إلى ذلك، تُقام معارض كبرى تعرض أحدث المعدات والتقنيات في عالم الفروسية، مما يوفر منصة مثالية للتواصل بين الفارس والمربين والمهتمين. يتطلب تنظيم هذه الفعاليات تنسيقًا محكمًا بين مختلف الأطراف، من المشاركين إلى الرعاة، لضمان تجربة مميزة للجميع.',
                'en' => 'Organizing and managing equestrian events is a vital field combining passion and professionalism. These events include various competitions, such as show jumping and endurance races, which require careful planning and preparation. In addition, major exhibitions showcasing the latest equipment and technologies in the equestrian world provide an ideal platform for networking between riders, breeders, and enthusiasts.'
            ],
            'video_gallery' => [
                [
                    'video_url' => 'https://www.youtube.com/watch?v=Ok180YwX8yA',
                    'thumbnail' => 'services/horses-reviews/1.webp'
                ],
                [
                    'video_url' => 'https://www.youtube.com/watch?v=Ok180YwX8yA',
                    'thumbnail' => 'services/horses-reviews/2.webp'
                ],
                [
                    'video_url' => 'https://www.youtube.com/watch?v=Ok180YwX8yA',
                    'thumbnail' => 'services/horses-reviews/3.webp'
                ],
                [
                    'video_url' => 'https://www.youtube.com/watch?v=Ok180YwX8yA',
                    'thumbnail' => 'services/horses-reviews/4.webp'
                ],
            ],
            'is_active' => true,
            'is_featured' => true,
        ]);

        // 3. Attach Images
        $basePath = '/Library/WebServer/Documents/Work/Hamdy/knights/public/images/services/horses-reviews/';

        // Main Image (1.webp)
        if (file_exists($basePath . '1.webp')) {
            $review->addMedia($basePath . '1.webp')
                ->preservingOriginal()
                ->toMediaCollection('image');
        }

        // Trainer Image (2.webp)
        if (file_exists($basePath . '2.webp')) {
            $review->addMedia($basePath . '2.webp')
                ->preservingOriginal()
                ->toMediaCollection('trainer_image');
        }

        // Gallery Images (1-6.webp)
        for ($i = 1; $i <= 6; $i++) {
            $file = $basePath . $i . '.webp';
            if (file_exists($file)) {
                $review->addMedia($file)
                    ->preservingOriginal()
                    ->toMediaCollection('gallery');
            }
        }

        // Add a few more dummy records for related section
        for ($i = 1; $i <= 3; $i++) {
            $related = \App\Models\HorseReview::create([
                'title' => [
                    'ar' => 'عرض خيل رقم ' . $i,
                    'en' => 'Horse Show #' . $i
                ],
                'description' => ['ar' => 'وصف مختصر...', 'en' => 'Short description...'],
                'price' => 500 * $i,
                'is_active' => true
            ]);

            if (file_exists($basePath . '3.webp')) {
                $related->addMedia($basePath . '3.webp')
                    ->preservingOriginal()
                    ->toMediaCollection('image');
            }
        }

        $this->command->info('Horse Review data seeded successfully into new independent model!');
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        // Product Categories
        $productCategories = [
            ['name' => ['ar' => 'معدات الخيل', 'en' => 'Horse Equipment'], 'slug' => 'horse-equipment', 'type' => 'product'],
            ['name' => ['ar' => 'ملابس الفروسية', 'en' => 'Riding Apparel'], 'slug' => 'riding-apparel', 'type' => 'product'],
            ['name' => ['ar' => 'أدوات العناية', 'en' => 'Grooming Tools'], 'slug' => 'grooming-tools', 'type' => 'product'],
            ['name' => ['ar' => 'السروج', 'en' => 'Saddles'], 'slug' => 'saddles', 'type' => 'product'],
            ['name' => ['ar' => 'اللجامات', 'en' => 'Bridles'], 'slug' => 'bridles', 'type' => 'product'],
            ['name' => ['ar' => 'أعلاف ومكملات', 'en' => 'Feed & Supplements'], 'slug' => 'feed-supplements', 'type' => 'product'],
        ];

        // Service Categories
        $serviceCategories = [
            ['name' => ['ar' => 'خدمات طبية بيطرية', 'en' => 'Veterinary Services'], 'slug' => 'veterinary-services', 'type' => 'service'],
            ['name' => ['ar' => 'تدريب الخيول', 'en' => 'Horse Training'], 'slug' => 'horse-training', 'type' => 'service'],
            ['name' => ['ar' => 'تدريب الفرسان', 'en' => 'Rider Training'], 'slug' => 'rider-training', 'type' => 'service'],
            ['name' => ['ar' => 'نقل الخيول', 'en' => 'Horse Transport'], 'slug' => 'horse-transport', 'type' => 'service'],
            ['name' => ['ar' => 'خدمات التصوير', 'en' => 'Photography Services'], 'slug' => 'photography', 'type' => 'service'],
            ['name' => ['ar' => 'صالون العناية', 'en' => 'Grooming Salon'], 'slug' => 'grooming-salon', 'type' => 'service'],
            ['name' => ['ar' => 'تنظيم الفعاليات', 'en' => 'Event Organization'], 'slug' => 'events', 'type' => 'service'],
            ['name' => ['ar' => 'تأمين الخيول', 'en' => 'Horse Insurance'], 'slug' => 'insurance', 'type' => 'service'],
            ['name' => ['ar' => 'استشارات', 'en' => 'Consultations'], 'slug' => 'consultations', 'type' => 'service'],
            ['name' => ['ar' => 'رحلات', 'en' => 'Trips'], 'slug' => 'trips', 'type' => 'service'],
        ];

        foreach (array_merge($productCategories, $serviceCategories) as $index => $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'type' => $category['type'],
                    'order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        $this->command->info('Categories seeded successfully!');
    }
}

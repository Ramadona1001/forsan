<?php

namespace Database\Seeders;

use App\Models\Photography;
use App\Models\PhotographyPackage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PhotographySeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'title' => ['ar' => 'التصوير الكلاسيكي', 'en' => 'Classical Photography'],
                'slug' => 'classical-photography',
                'description' => ['ar' => 'خدمة التصوير الكلاسيكي توفر تجربة فريدة لالتقاط صور فنية رائعة.', 'en' => 'Classical photography service providing unique artistic photos.'],
                'price' => 1000,
                'video_gallery' => [
                    ['video_url' => 'https://www.youtube.com/watch?v=Ok180YwX8yA'],
                    ['video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'],
                ],
            ],
            [
                'title' => ['ar' => 'التصوير حسب الطلب', 'en' => 'Photography on Demand'],
                'slug' => 'photography-on-demand',
                'description' => ['ar' => 'خدمة تصوير مخصصة حسب رغبة العميل واختياره للمكان والوقت.', 'en' => 'Custom photography service based on client preference.'],
                'price' => 1500,
                'video_gallery' => [
                    ['video_url' => 'https://www.youtube.com/watch?v=Ok180YwX8yA'],
                ],
            ],
            [
                'title' => ['ar' => 'خدمات تصوير الخيل', 'en' => 'Horse Photography'],
                'slug' => 'horse-photography',
                'description' => ['ar' => 'التقاط صور احترافية للخيول تبرز جمالها وقوتها.', 'en' => 'Professional horse photography highlighting beauty and strength.'],
                'price' => 1200,
                'video_gallery' => [
                    ['video_url' => 'https://www.youtube.com/watch?v=Ok180YwX8yA'],
                    ['video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'],
                ],
            ],
            [
                'title' => ['ar' => 'تصوير الفعاليات', 'en' => 'Event Photography'],
                'slug' => 'event-photography',
                'description' => ['ar' => 'تغطية شاملة للفعاليات والمناسبات بجودة عالية.', 'en' => 'Comprehensive event coverage with high quality.'],
                'price' => 2000,
                'video_gallery' => [
                    ['video_url' => 'https://www.youtube.com/watch?v=Ok180YwX8yA'],
                ],
            ],
            [
                'title' => ['ar' => 'تصوير البطولات', 'en' => 'Championship Photography'],
                'slug' => 'championship-photography',
                'description' => ['ar' => 'توثيق لحظات البطولات والمنافسات الرياضية.', 'en' => 'Documenting championship moments and sports competitions.'],
                'price' => 2500,
                'video_gallery' => [
                    ['video_url' => 'https://www.youtube.com/watch?v=Ok180YwX8yA'],
                ],
            ],
            [
                'title' => ['ar' => 'خدمات التصوير للفيديوهات', 'en' => 'Video Services'],
                'slug' => 'video-services',
                'description' => ['ar' => 'إنتاج فيديوهات احترافية للأفلام والفعاليات.', 'en' => 'Professional video production for films and events.'],
                'price' => 3000,
                'video_gallery' => [
                    ['video_url' => 'https://www.youtube.com/watch?v=Ok180YwX8yA'],
                    ['video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'],
                    ['video_url' => 'https://www.youtube.com/watch?v=jNQXAC9IVRw'],
                ],
            ],
        ];

        foreach ($services as $data) {
            $photography = Photography::create($data);

            // Create some dummy packages
            PhotographyPackage::create([
                'photography_id' => $photography->id,
                'name' => ['ar' => 'الباقة الأساسية', 'en' => 'Basic Package'],
                'price' => $data['price'],
                'description' => ['ar' => 'باقة تشمل الأساسيات.', 'en' => 'Package includes basics.'],
                'features' => ['ar' => ['عدد 10 صور', 'ساعة تصوير'], 'en' => ['10 Photos', '1 Hour Shooting']],
            ]);

            PhotographyPackage::create([
                'photography_id' => $photography->id,
                'name' => ['ar' => 'الباقة المميزة', 'en' => 'Premium Package'],
                'price' => $data['price'] * 1.5,
                'description' => ['ar' => 'باقة شاملة ومميزة.', 'en' => 'Comprehensive premium package.'],
                'features' => ['ar' => ['عدد 30 صور', '3 ساعات تصوير', 'ألبوم'], 'en' => ['30 Photos', '3 Hours Shooting', 'Album']],
            ]);
        }
    }
}

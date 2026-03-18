<?php

namespace Database\Seeders;

use App\Models\Collaboration;
use Illuminate\Database\Seeder;

class CollaborationSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'slug' => 'labeh-app',
                'title' => ['ar' => 'تطبيق لبيه', 'en' => 'Labeh App'],
                'description' => [
                    'ar' => 'التعاون مع تطبيق لبيه لتقديم خدمات دعم الصحة النفسية والإرشاد للفرسان والمدربين ومحبي الخيول. يهدف هذا التعاون إلى دعم الصحة النفسية للأشخاص المشاركين في رياضة الفروسية، من خلال توفير موارد متخصصة ومتاحة بسهولة.',
                    'en' => 'Collaboration with Labeh app to provide mental health support and counseling services for riders, trainers and horse lovers.',
                ],
                'link_text' => ['ar' => 'yomiuri.co.jp', 'en' => 'yomiuri.co.jp'],
                'sort_order' => 1,
            ],
            [
                'slug' => 'rehabilitation-physiotherapy',
                'title' => ['ar' => 'التأهيل والعلاج الطبيعي', 'en' => 'Rehabilitation and Physiotherapy'],
                'description' => [
                    'ar' => 'التعاون مع تطبيق لبيه لتقديم خدمات دعم الصحة النفسية والإرشاد للفرسان والمدربين ومحبي الخيول. يهدف هذا التعاون إلى دعم الصحة النفسية للأشخاص المشاركين في رياضة الفروسية، من خلال توفير موارد متخصصة ومتاحة بسهولة.',
                    'en' => 'Collaboration to provide rehabilitation and physiotherapy services for riders and horses.',
                ],
                'link_text' => ['ar' => 'yomiuri.co.jp', 'en' => 'yomiuri.co.jp'],
                'sort_order' => 2,
            ],
            [
                'slug' => 'specialized-nutrition-partnerships',
                'title' => ['ar' => 'شراكات التغذية المتخصصة', 'en' => 'Specialized Nutrition Partnerships'],
                'description' => [
                    'ar' => 'التعاون مع تطبيق لبيه لتقديم خدمات دعم الصحة النفسية والإرشاد للفرسان والمدربين ومحبي الخيول. يهدف هذا التعاون إلى دعم الصحة النفسية للأشخاص المشاركين في رياضة الفروسية، من خلال توفير موارد متخصصة ومتاحة بسهولة.',
                    'en' => 'Partnerships for specialized nutrition services for equestrian athletes.',
                ],
                'link_text' => ['ar' => 'yomiuri.co.jp', 'en' => 'yomiuri.co.jp'],
                'sort_order' => 3,
            ],
            [
                'slug' => 'health-insurance-providers',
                'title' => ['ar' => 'الشراكة مع مزودي التأمين الصحي', 'en' => 'Partnership with Health Insurance Providers'],
                'description' => [
                    'ar' => 'التعاون مع تطبيق لبيه لتقديم خدمات دعم الصحة النفسية والإرشاد للفرسان والمدربين ومحبي الخيول. يهدف هذا التعاون إلى دعم الصحة النفسية للأشخاص المشاركين في رياضة الفروسية، من خلال توفير موارد متخصصة ومتاحة بسهولة.',
                    'en' => 'Partnership with health insurance providers for comprehensive coverage.',
                ],
                'link_text' => ['ar' => 'yomiuri.co.jp', 'en' => 'yomiuri.co.jp'],
                'sort_order' => 4,
            ],
        ];

        foreach ($items as $data) {
            Collaboration::updateOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, ['is_active' => true])
            );
        }
    }
}

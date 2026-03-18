<?php

namespace Database\Seeders;

use App\Models\InformationPage;
use Illuminate\Database\Seeder;

class InformationPageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'our-horses-our-responsibility',
                'title' => ['ar' => 'خيولنا مسؤوليتنا', 'en' => 'Our Horses Our Responsibility'],
                'content' => ['ar' => 'لوريم ايبسوم دولار سيت أميت ،كونسيكتيتور أدايبا يسكينج أليايت، سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا. يوت انيم أد مينيم فينايم، كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات.', 'en' => ''],
                'template' => InformationPage::TEMPLATE_DEFAULT,
                'sort_order' => 1,
            ],
            [
                'slug' => 'people-with-special-needs',
                'title' => ['ar' => 'ذوى الاحتياجات', 'en' => 'People with Special Needs'],
                'content' => ['ar' => 'لوريم ايبسوم دولار سيت أميت ،كونسيكتيتور أدايبا يسكينج أليايت، سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا.', 'en' => ''],
                'template' => InformationPage::TEMPLATE_DEFAULT,
                'sort_order' => 2,
            ],
            [
                'slug' => 'digital-services',
                'title' => ['ar' => 'الخدمات الرقمية', 'en' => 'Digital Services'],
                'content' => ['ar' => 'لوريم ايبسوم دولار سيت أميت ،كونسيكتيتور أدايبا يسكينج أليايت، سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا.', 'en' => ''],
                'extra_section_title' => ['ar' => 'الجدوال الدولية للبطولات العالمية والمحلية', 'en' => 'International Championships Calendar'],
                'template' => InformationPage::TEMPLATE_WITH_TABLE,
                'table_data' => [
                    ['type' => 'محليه', 'date' => '12/2/2024', 'time' => '10 مساء', 'place' => 'جدة المملكة العربية السعودية', 'details' => 'http://www.example.com'],
                    ['type' => 'محليه', 'date' => '12/2/2024', 'time' => '10 مساء', 'place' => 'جدة المملكة العربية السعودية', 'details' => 'http://www.example.com'],
                ],
                'sort_order' => 3,
            ],
            [
                'slug' => 'safety',
                'title' => ['ar' => 'معايير السلامة', 'en' => 'Safety Standards'],
                'content' => ['ar' => 'لوريم ايبسوم دولار سيت أميت ،كونسيكتيتور أدايبا يسكينج أليايت، سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا.', 'en' => ''],
                'extra_section_title' => ['ar' => 'منتجات معتمدة من FEI', 'en' => 'FEI Approved Products'],
                'template' => InformationPage::TEMPLATE_WITH_PRODUCTS_SLIDER,
                'sort_order' => 4,
            ],
            [
                'slug' => 'equestrian-sports-overview',
                'title' => ['ar' => 'نظرة عامة على رياضات الفروسية', 'en' => 'Overview of Equestrian Sports'],
                'content' => ['ar' => 'لوريم ايبسوم دولار سيت أميت ،كونسيكتيتور أدايبا يسكينج أليايت، سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا.', 'en' => ''],
                'extra_section_title' => ['ar' => 'الرياضات', 'en' => 'Sports'],
                'template' => InformationPage::TEMPLATE_WITH_SPORTS_SLIDER,
                'sort_order' => 5,
            ],
        ];

        foreach ($pages as $data) {
            $tableData = $data['table_data'] ?? null;
            $extraTitle = $data['extra_section_title'] ?? null;
            unset($data['table_data'], $data['extra_section_title']);
            if ($tableData !== null) {
                $data['table_data'] = $tableData;
            }
            if ($extraTitle !== null) {
                $data['extra_section_title'] = $extraTitle;
            }
            InformationPage::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}

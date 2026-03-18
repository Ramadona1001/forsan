<?php

namespace Database\Seeders;

use App\Models\EquestrianSport;
use App\Models\InformationPage;
use Illuminate\Database\Seeder;

class EquestrianSportSeeder extends Seeder
{
    public function run(): void
    {
        $page = InformationPage::where('slug', 'equestrian-sports-overview')->first();
        if (! $page) {
            return;
        }

        $sports = [
            [
                'slug' => 'endurance',
                'title' => ['ar' => 'القدرة والتحمل', 'en' => 'Endurance and Stamina'],
                'content' => ['ar' => 'لوريم ايبسوم دولار سيت أميت ،كونسيكتيتور أدايبا يسكينج أليايت، سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا. يوت انيم أد مينيم فينايم، كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات.', 'en' => ''],
                'sort_order' => 1,
            ],
            [
                'slug' => 'dressage',
                'title' => ['ar' => 'البرساج', 'en' => 'Dressage'],
                'content' => ['ar' => 'لوريم ايبسوم دولار سيت أميت ،كونسيكتيتور أدايبا يسكينج أليايت، سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا.', 'en' => ''],
                'sort_order' => 2,
            ],
            [
                'slug' => 'cross-country',
                'title' => ['ar' => 'الكروس كنتري', 'en' => 'Cross Country'],
                'content' => ['ar' => 'لوريم ايبسوم دولار سيت أميت ،كونسيكتيتور أدايبا يسكينج أليايت، سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا.', 'en' => ''],
                'sort_order' => 3,
            ],
            [
                'slug' => 'show-jumping',
                'title' => ['ar' => 'قفز الحواجز', 'en' => 'Show Jumping'],
                'content' => ['ar' => 'لوريم ايبسوم دولار سيت أميت ،كونسيكتيتور أدايبا يسكينج أليايت، سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا.', 'en' => ''],
                'sort_order' => 4,
            ],
            [
                'slug' => 'tent-pegging',
                'title' => ['ar' => 'التقاط الأوتاد', 'en' => 'Tent Pegging'],
                'content' => ['ar' => 'لوريم ايبسوم دولار سيت أميت ،كونسيكتيتور أدايبا يسكينج أليايت، سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا.', 'en' => ''],
                'sort_order' => 5,
            ],
        ];

        foreach ($sports as $data) {
            EquestrianSport::updateOrCreate(
                [
                    'information_page_id' => $page->id,
                    'slug' => $data['slug'],
                ],
                array_merge($data, ['is_active' => true])
            );
        }
    }
}

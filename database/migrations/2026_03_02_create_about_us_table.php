<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('about_image')->nullable();
            $table->json('about_title')->nullable();
            $table->json('about_content')->nullable();
            $table->json('vision_title')->nullable();
            $table->json('vision_content')->nullable();
            $table->json('goals_title')->nullable();
            $table->json('goals_content')->nullable();
            $table->json('quote_text')->nullable();
            $table->string('services_heading')->nullable();
            $table->string('services_subtext')->nullable();
            $table->string('partners_heading')->nullable();
            $table->string('knights_heading')->nullable();
            $table->string('sports_heading')->nullable();
            $table->string('sports_subtext')->nullable();
            $table->timestamps();
        });

        \DB::table('about_us')->insert([
            'about_title' => json_encode(['ar' => 'من نحن', 'en' => 'About Us']),
            'about_content' => json_encode(['ar' => 'لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواسأيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايتنيولا باراياتيور.', 'en' => '']),
            'vision_title' => json_encode(['ar' => 'الرؤية', 'en' => 'Vision']),
            'vision_content' => json_encode(['ar' => 'لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا.', 'en' => '']),
            'goals_title' => json_encode(['ar' => 'الأهداف', 'en' => 'Goals']),
            'goals_content' => json_encode(['ar' => 'لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا.', 'en' => '']),
            'quote_text' => json_encode(['ar' => 'لخيلُ معقودٌ في نواصيها الخيرُ إلى يومِ القيامةِ', 'en' => '']),
            'services_heading' => 'خدماتنا',
            'services_subtext' => 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة.',
            'partners_heading' => 'الجهات الراعية',
            'knights_heading' => 'فرساننا',
            'sports_heading' => 'الرياضات',
            'sports_subtext' => 'للرياضات الخيل الموجودة في المملكة العربية السعودية',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};

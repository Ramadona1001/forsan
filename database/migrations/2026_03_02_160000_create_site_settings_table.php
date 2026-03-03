<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->json('contact_banner_heading')->nullable()->comment('عنوان بانر اتصل بنا ar/en');
            $table->json('contact_address')->nullable()->comment('عنوان الموقع أسطر متعددة ar/en');
            $table->string('contact_phone')->nullable();
            $table->string('contact_whatsapp')->nullable();
            $table->string('contact_email')->nullable();
            $table->json('working_hours')->nullable()->comment('ساعات العمل ar/en');
            $table->string('logo')->nullable()->comment('مسار اللوجو');
            $table->timestamps();
        });

        \DB::table('site_settings')->insert([
            'contact_banner_heading' => json_encode([
                'ar' => 'نتطلع إلى الاستماع إليك دائماً. تواصل معنا وسنكون سعداء بالإجابة على استفسارك',
                'en' => 'We look forward to hearing from you. Contact us and we will be happy to answer your inquiry',
            ]),
            'contact_address' => json_encode([
                'ar' => "المملكة العربية السعودية\nالرياض، حي العليا\nشارع الأمير محمد بن عبد العزيز",
                'en' => "Kingdom of Saudi Arabia\nRiyadh, Al Olaya District\nPrince Mohammed bin Abdulaziz Street",
            ]),
            'contact_phone' => '+966500000000',
            'contact_whatsapp' => '966500000000',
            'contact_email' => 'info@knights.com',
            'working_hours' => json_encode([
                'ar' => "السبت - الخميس: 9:00 صباحاً - 9:00 مساءً\nالجمعة: مغلق",
                'en' => "Saturday - Thursday: 9:00 AM - 9:00 PM\nFriday: Closed",
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};

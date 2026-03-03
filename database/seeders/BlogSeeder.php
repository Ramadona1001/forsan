<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        Blog::truncate();
        // Get or create an author
        $author = User::first();

        if (!$author) {
            $this->command->warn('No user found. Please create a user first.');
            return;
        }

        // Get or create blog category
        $category = Category::firstOrCreate(
            ['slug' => 'blog', 'type' => 'blog'],
            [
                'name' => ['ar' => 'مدونات', 'en' => 'Blogs'],
                'description' => ['ar' => 'مقالات ومدونات متنوعة', 'en' => 'Various articles and blogs'],
                'is_active' => true,
                'order' => 1,
            ]
        );

        $blogs = [
            [
                'title' => [
                    'ar' => 'رحلة استكشافية في صحراء الربع الخالي',
                    'en' => 'Exploratory Journey in the Empty Quarter Desert',
                ],
                'slug' => 'empty-quarter-expedition',
                'excerpt' => [
                    'ar' => 'انطلق معنا في رحلة مثيرة عبر أكبر صحراء رملية في العالم، حيث الكثبان الذهبية والسماء الصافية',
                    'en' => 'Join us on an exciting journey through the largest sand desert in the world',
                ],
                'content' => [
                    'ar' => '<p>تعتبر صحراء الربع الخالي واحدة من أكثر الأماكن سحراً على وجه الأرض. في هذه الرحلة الاستكشافية، قمنا بالتخييم تحت النجوم والتعرف على ثقافة البدو الأصيلة.</p>
<h3>ما يميز هذه الرحلة</h3>
<ul>
<li>ركوب الجمال عبر الكثبان الرملية الذهبية</li>
<li>السهرات البدوية التقليدية</li>
<li>مشاهدة شروق الشمس من قمة الكثبان</li>
<li>تذوق المأكولات التراثية</li>
</ul>
<p>إنها تجربة لا تُنسى تأخذك إلى عالم آخر من الهدوء والجمال الطبيعي.</p>',
                    'en' => '<p>The Empty Quarter desert is one of the most magical places on earth. In this expedition, we camped under the stars and learned about authentic Bedouin culture.</p>',
                ],
                'tags' => ['صحراء', 'ربع خالي', 'مغامرة', 'تخييم'],
                'is_published' => true,
                'is_featured' => true,
                'views_count' => 1250,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => [
                    'ar' => 'الفروسية العربية: تراث عريق وفن أصيل',
                    'en' => 'Arabian Horsemanship: Ancient Heritage and Authentic Art',
                ],
                'slug' => 'arabian-horsemanship-heritage',
                'excerpt' => [
                    'ar' => 'تعرف على تاريخ الفروسية العربية وأهم تقاليدها وكيف نحافظ عليها في خطى الفرسان',
                    'en' => 'Learn about the history of Arabian horsemanship and its key traditions',
                ],
                'content' => [
                    'ar' => '<p>الفروسية العربية ليست مجرد رياضة، بل هي فن وتراث يمتد لآلاف السنين. في خطى الفرسان، نعمل على الحفاظ على هذا التراث وتعليمه للأجيال الجديدة.</p>
<h3>أهمية الحصان العربي</h3>
<p>يتميز الحصان العربي بأصالته وذكائه وقوة تحمله، مما جعله رفيقاً مثالياً للفرسان عبر التاريخ.</p>
<h3>برامجنا التدريبية</h3>
<ul>
<li>دورات الفروسية للمبتدئين</li>
<li>تدريب متقدم على التقنيات التقليدية</li>
<li>رعاية وتغذية الخيول</li>
<li>مسابقات وعروض الفروسية</li>
</ul>',
                    'en' => '<p>Arabian horsemanship is not just a sport, but an art and heritage spanning thousands of years.</p>',
                ],
                'tags' => ['فروسية', 'خيول', 'تراث', 'تدريب'],
                'is_published' => true,
                'is_featured' => true,
                'views_count' => 980,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => [
                    'ar' => 'أفضل 5 وجهات للتخييم في المملكة',
                    'en' => 'Top 5 Camping Destinations in the Kingdom',
                ],
                'slug' => 'top-5-camping-destinations',
                'excerpt' => [
                    'ar' => 'اكتشف أجمل أماكن التخييم في المملكة العربية السعودية مع نصائح للتحضير لرحلتك',
                    'en' => 'Discover the most beautiful camping spots in Saudi Arabia',
                ],
                'content' => [
                    'ar' => '<p>المملكة العربية السعودية تزخر بأماكن رائعة للتخييم والاستمتاع بالطبيعة. إليكم قائمة بأفضل 5 وجهات:</p>
<h3>1. وادي لجب</h3>
<p>واحة خضراء وسط الجبال، مثالية للتخييم الصيفي.</p>
<h3>2. محمية الحرة</h3>
<p>تضاريس بركانية فريدة وليالٍ صافية لمشاهدة النجوم.</p>
<h3>3. جبال عسير</h3>
<p>أجواء معتدلة وطبيعة خلابة طوال العام.</p>
<h3>4. شاطئ أملج</h3>
<p>التخييم على البحر الأحمر بمياهه الفيروزية.</p>
<h3>5. صحراء نفود</h3>
<p>تجربة صحراوية أصيلة مع الكثبان الحمراء.</p>
<h3>نصائح للتخييم</h3>
<ul>
<li>تأكد من حمل كمية كافية من الماء</li>
<li>استخدم معدات تخييم عالية الجودة</li>
<li>تابع حالة الطقس قبل الانطلاق</li>
</ul>',
                    'en' => '<p>Saudi Arabia is full of amazing camping destinations.</p>',
                ],
                'tags' => ['تخييم', 'سياحة', 'طبيعة', 'نصائح'],
                'is_published' => true,
                'is_featured' => false,
                'views_count' => 2100,
                'published_at' => now()->subDays(15),
            ],
            [
                'title' => [
                    'ar' => 'فعاليات موسم الصيف: رحلات وأنشطة حصرية',
                    'en' => 'Summer Season Events: Exclusive Trips and Activities',
                ],
                'slug' => 'summer-season-events',
                'excerpt' => [
                    'ar' => 'تعرف على جدول فعالياتنا المميزة لموسم الصيف مع عروض خاصة للعائلات',
                    'en' => 'Check out our special summer events schedule with family offers',
                ],
                'content' => [
                    'ar' => '<p>نقدم لكم في خطى الفرسان مجموعة متميزة من الفعاليات والرحلات الصيفية:</p>
<h3>رحلات نهاية الأسبوع</h3>
<p>رحلات قصيرة للتخييم والمغامرة مناسبة للعائلات.</p>
<h3>معسكرات الفروسية الصيفية</h3>
<p>برامج متكاملة لتعلم الفروسية للأطفال والكبار.</p>
<h3>جولات السفاري الليلية</h3>
<p>استكشف الحياة البرية في الليل مع مرشدينا المتخصصين.</p>
<h3>العروض الخاصة</h3>
<ul>
<li>خصم 20% للعائلات</li>
<li>رحلة مجانية لكل 5 حجوزات</li>
<li>باقات شاملة بأسعار تنافسية</li>
</ul>',
                    'en' => '<p>We present a distinguished collection of summer events and trips at Knights Steps.</p>',
                ],
                'tags' => ['فعاليات', 'صيف', 'عروض', 'عائلات'],
                'is_published' => true,
                'is_featured' => false,
                'views_count' => 750,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => [
                    'ar' => 'كيف تستعد لرحلة صحراوية ناجحة؟',
                    'en' => 'How to Prepare for a Successful Desert Trip?',
                ],
                'slug' => 'prepare-desert-trip-guide',
                'excerpt' => [
                    'ar' => 'دليل شامل للتحضير لرحلتك الصحراوية مع قائمة بالمعدات الضرورية',
                    'en' => 'A comprehensive guide to prepare for your desert trip',
                ],
                'content' => [
                    'ar' => '<p>الرحلات الصحراوية تجربة فريدة تتطلب تحضيراً جيداً. إليكم دليلنا الشامل:</p>
<h3>الملابس المناسبة</h3>
<ul>
<li>ملابس قطنية فضفاضة</li>
<li>قبعة أو شماغ للحماية من الشمس</li>
<li>جاكيت خفيف للمساء</li>
<li>أحذية مريحة ومتينة</li>
</ul>
<h3>المعدات الأساسية</h3>
<ul>
<li>خيمة مناسبة للصحراء</li>
<li>كيس نوم ذو جودة عالية</li>
<li>مصباح يدوي قوي</li>
<li>أدوات الطبخ والتخييم</li>
</ul>
<h3>الصحة والسلامة</h3>
<ul>
<li>كمية كافية من الماء (4 لتر يومياً)</li>
<li>واقي شمس عالي الحماية</li>
<li>حقيبة إسعافات أولية</li>
<li>خريطة وبوصلة أو GPS</li>
</ul>',
                    'en' => '<p>Desert trips are a unique experience that requires good preparation.</p>',
                ],
                'tags' => ['صحراء', 'تحضير', 'دليل', 'معدات'],
                'is_published' => true,
                'is_featured' => false,
                'views_count' => 1500,
                'published_at' => now()->subDays(20),
            ],
            [
                'title' => [
                    'ar' => 'قصص من التراث: حكايات الفرسان العرب',
                    'en' => 'Stories from Heritage: Tales of Arab Knights',
                ],
                'slug' => 'arab-knights-tales',
                'excerpt' => [
                    'ar' => 'رحلة عبر الزمن مع أشهر قصص الفروسية والشجاعة في التراث العربي',
                    'en' => 'A journey through time with the most famous stories of horsemanship and bravery',
                ],
                'content' => [
                    'ar' => '<p>التراث العربي مليء بقصص البطولة والفروسية التي ألهمت الأجيال. نقدم لكم بعضاً من أشهر هذه القصص:</p>
<h3>عنترة بن شداد</h3>
<p>الفارس الشجاع الذي تحدى الصعاب وأصبح رمزاً للشجاعة والإقدام.</p>
<h3>الزير سالم</h3>
<p>البطل الذي خاض أشرس المعارك ولم يعرف الهزيمة طريقاً إليه.</p>
<h3>خالد بن الوليد</h3>
<p>سيف الله المسلول، القائد العسكري الفذ الذي لم يُهزم في معركة.</p>
<h3>دروس من التراث</h3>
<ul>
<li>الشجاعة في مواجهة التحديات</li>
<li>الكرم والنخوة العربية</li>
<li>الوفاء بالعهد</li>
<li>حب الخيل والعناية بها</li>
</ul>',
                    'en' => '<p>Arab heritage is full of stories of heroism and chivalry that inspired generations.</p>',
                ],
                'tags' => ['تراث', 'فروسية', 'قصص', 'تاريخ'],
                'is_published' => true,
                'is_featured' => true,
                'views_count' => 890,
                'published_at' => now()->subDays(25),
            ],
        ];

        foreach ($blogs as $index => $blogData) {
            $blog = Blog::create([
                'author_id' => $author->id,
                'category_id' => $category->id,
                'title' => $blogData['title'],
                'slug' => $blogData['slug'],
                'excerpt' => $blogData['excerpt'],
                'content' => $blogData['content'],
                'tags' => $blogData['tags'],
                'is_published' => $blogData['is_published'],
                'is_featured' => $blogData['is_featured'],
                'views_count' => $blogData['views_count'],
                'published_at' => $blogData['published_at'],
            ]);

            // Assuming images match index + 1
            $imagePath = public_path('images/blogs/' . ($index + 1) . '.webp');
            if (file_exists($imagePath)) {
                $blog->addMedia($imagePath)->preservingOriginal()->toMediaCollection('featured_image');
            }
        }

        $this->command->info('✅ Created ' . count($blogs) . ' blog posts successfully!');
    }
}

<?php

return [
    // مجموعات التنقل
    'navigation' => [
        'services_management' => 'إدارة الخدمات',
        'horses_management' => 'إدارة الخيول',
        'ecommerce' => 'التجارة الإلكترونية',
        'content_management' => 'إدارة المحتوى',
        'users_management' => 'المستخدمين والصلاحيات',
        'settings' => 'الإعدادات',
    ],

    // الموارد
    'resources' => [
        // الخدمات
        'service' => [
            'navigation_label' => 'الخدمات',
            'model_label' => 'خدمة',
            'plural_label' => 'الخدمات',
        ],
        'service_tab' => [
            'navigation_label' => 'تبويبات الخدمات',
            'model_label' => 'تبويب',
            'plural_label' => 'تبويبات الخدمات',
        ],
        'service_package' => [
            'navigation_label' => 'باقات الخدمات',
            'model_label' => 'باقة',
            'plural_label' => 'باقات الخدمات',
        ],
        'booking' => [
            'navigation_label' => 'الحجوزات',
            'model_label' => 'حجز',
            'plural_label' => 'الحجوزات',
        ],

        // الخيول
        'horse' => [
            'navigation_label' => 'الخيول',
            'model_label' => 'حصان',
            'plural_label' => 'الخيول',
        ],
        'stable' => [
            'navigation_label' => 'الإسطبلات',
            'model_label' => 'إسطبل',
            'plural_label' => 'الإسطبلات',
        ],
        'trainer' => [
            'navigation_label' => 'المدربين',
            'model_label' => 'مدرب',
            'plural_label' => 'المدربين',
        ],

        // التجارة الإلكترونية
        'product' => [
            'navigation_label' => 'المنتجات',
            'model_label' => 'منتج',
            'plural_label' => 'المنتجات',
            'sections' => [
                'basic_info' => 'المعلومات الأساسية',
                'pricing' => 'التسعير',
                'inventory' => 'المخزون',
                'media' => 'الوسائط',
                'attributes' => 'السمات',
                'settings' => 'الإعدادات',
            ],
            'fields' => [
                'name' => 'اسم المنتج',
                'main_image' => 'الصورة الرئيسية',
                'store' => 'المتجر',
                'category' => 'التصنيف',
                'sku' => 'SKU',
                'description' => 'الوصف',
                'price' => 'السعر',
                'compare_price' => 'السعر قبل الخصم',
                'cost' => 'التكلفة',
                'stock' => 'الكمية',
                'low_stock_threshold' => 'حد التنبيه',
                'track_inventory' => 'تتبع المخزون',
                'gallery' => 'معرض الصور',
                'sizes' => 'المقاسات المتاحة',
                'colors' => 'الالوان المتاحة',
                'color' => 'اللون',
                'is_active' => 'نشط',
                'is_featured' => 'مميز',
                'sales' => 'المبيعات',
                'add_size_placeholder' => 'أضف مقاس جديد',
                'add_size_helper' => 'اضغط Enter لإضافة المقاس',
            ],
        ],
        'order' => [
            'navigation_label' => 'الطلبات',
            'model_label' => 'طلب',
            'plural_label' => 'الطلبات',
        ],
        'store' => [
            'navigation_label' => 'المتاجر',
            'model_label' => 'متجر',
            'plural_label' => 'المتاجر',
        ],

        // إدارة المحتوى
        'category' => [
            'navigation_label' => 'الأقسام',
            'model_label' => 'قسم',
            'plural_label' => 'الأقسام',
        ],
        'blog' => [
            'navigation_label' => 'المدونة',
            'model_label' => 'مقالة',
            'plural_label' => 'المدونة',
        ],
        'page' => [
            'navigation_label' => 'الصفحات',
            'model_label' => 'صفحة',
            'plural_label' => 'الصفحات',
        ],
        'slider' => [
            'navigation_label' => 'السلايدر',
            'model_label' => 'سلايد',
            'plural_label' => 'السلايدر',
        ],
        'banner' => [
            'navigation_label' => 'البنرات',
            'model_label' => 'بنر',
            'plural_label' => 'البنرات',
        ],
        'sponsor' => [
            'navigation_label' => 'الرعاة',
            'model_label' => 'راعي',
            'plural_label' => 'الرعاة',
        ],
        'contact_message' => [
            'navigation_label' => 'رسائل اتصل بنا',
            'model_label' => 'رسالة',
            'plural_label' => 'رسائل اتصل بنا',
            'mark_read' => 'تحديد كمقروءة',
        ],

        // المستخدمين
        'user' => [
            'navigation_label' => 'المستخدمين',
            'model_label' => 'مستخدم',
            'plural_label' => 'المستخدمين',
        ],
    ],

    // Common Fields / الحقول المشتركة
    'fields' => [
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'phone' => 'رقم الهاتف',
        'description' => 'الوصف',
        'address' => 'العنوان',
        'city' => 'المدينة',
        'country' => 'الدولة',
        'status' => 'الحالة',
        'active' => 'نشط',
        'featured' => 'مميز',
        'verified' => 'موثق',
        'price' => 'السعر',
        'date' => 'التاريخ',
        'time' => 'الوقت',
        'created_at' => 'تاريخ الإنشاء',
        'updated_at' => 'تاريخ التحديث',
        'subject' => 'الموضوع',
        'message' => 'الرسالة',
        'read' => 'مقروءة',

        // Booking fields
        'booking_number' => 'رقم الحجز',
        'customer' => 'العميل',
        'service' => 'الخدمة',
        'horse' => 'الحصان',
        'start_time' => 'وقت البدء',
        'end_time' => 'وقت الانتهاء',
        'duration' => 'المدة',
        'payment_status' => 'حالة الدفع',
        'payment_method' => 'طريقة الدفع',
        'notes' => 'ملاحظات',
        'customer_notes' => 'ملاحظات العميل',
        'provider_notes' => 'ملاحظات مقدم الخدمة',
        'cancellation_reason' => 'سبب الإلغاء',

        // Trainer fields
        'user' => 'المستخدم',
        'stable' => 'الإسطبل',
        'bio' => 'السيرة الذاتية',
        'specializations' => 'التخصصات',
        'experience_years' => 'سنوات الخبرة',
        'hourly_rate' => 'السعر بالساعة',
        'rating' => 'التقييم',
        'reviews_count' => 'عدد التقييمات',
        'students_count' => 'عدد الطلاب',
        'license_number' => 'رقم الترخيص',
        'license_expiry' => 'تاريخ انتهاء الترخيص',
        'certificates' => 'الشهادات',
        'photo' => 'الصورة',

        // Store fields
        'owner' => 'المالك',
        'website' => 'الموقع الإلكتروني',
        'logo' => 'الشعار',
        'cover' => 'صورة الغلاف',
        'gallery' => 'معرض الصور',

        // Section titles
        'basic_info' => 'المعلومات الأساسية',
        'booking_info' => 'معلومات الحجز',
        'timing' => 'التوقيت',
        'stats_status' => 'الإحصائيات والحالة',
        'license' => 'الترخيص',
        'specializations_experience' => 'التخصصات والخبرة',
    ],

    // Pages (إعدادات الموقع وغيرها)
    'pages' => [
        'site_settings' => [
            'title' => 'إعدادات الموقع',
            'nav_label' => 'إعدادات الموقع',
            'contact_section' => 'تفاصيل الاتصال (صفحة اتصل بنا)',
            'banner_heading' => 'نص بانر اتصل بنا',
            'address' => 'العنوان',
            'working_hours' => 'ساعات العمل',
            'logo_section' => 'الشعار والأيقونة',
            'logo' => 'لوجو الموقع',
            'favicon' => 'أيقونة الموقع (Favicon)',
            'save_btn' => 'حفظ',
            'saved' => 'تم حفظ الإعدادات بنجاح.',
        ],
    ],
];

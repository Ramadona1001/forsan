<?php

return [
    // Navigation Groups
    'navigation' => [
        'services_management' => 'Services Management',
        'horses_management' => 'Horses Management',
        'ecommerce' => 'E-Commerce',
        'content_management' => 'Content Management',
        'users_management' => 'Users & Access',
        'settings' => 'Settings',
    ],

    // Resources
    'resources' => [
        // Services
        'service' => [
            'navigation_label' => 'Services',
            'model_label' => 'Service',
            'plural_label' => 'Services',
        ],
        'service_tab' => [
            'navigation_label' => 'Service Tabs',
            'model_label' => 'Tab',
            'plural_label' => 'Service Tabs',
        ],
        'service_package' => [
            'navigation_label' => 'Service Packages',
            'model_label' => 'Package',
            'plural_label' => 'Service Packages',
        ],
        'booking' => [
            'navigation_label' => 'Bookings',
            'model_label' => 'Booking',
            'plural_label' => 'Bookings',
        ],

        // Horses
        'horse' => [
            'navigation_label' => 'Horses',
            'model_label' => 'Horse',
            'plural_label' => 'Horses',
        ],
        'stable' => [
            'navigation_label' => 'Stables',
            'model_label' => 'Stable',
            'plural_label' => 'Stables',
        ],
        'trainer' => [
            'navigation_label' => 'Trainers',
            'model_label' => 'Trainer',
            'plural_label' => 'Trainers',
        ],

        // E-Commerce
        'product' => [
            'navigation_label' => 'Products',
            'model_label' => 'Product',
            'plural_label' => 'Products',
            'sections' => [
                'basic_info' => 'Basic Information',
                'pricing' => 'Pricing',
                'inventory' => 'Inventory',
                'media' => 'Media',
                'attributes' => 'Attributes',
                'settings' => 'Settings',
            ],
            'fields' => [
                'name' => 'Product Name',
                'main_image' => 'Main Image',
                'store' => 'Store',
                'category' => 'Category',
                'sku' => 'SKU',
                'description' => 'Description',
                'price' => 'Price',
                'compare_price' => 'Compare Price',
                'cost' => 'Cost',
                'stock' => 'Stock',
                'low_stock_threshold' => 'Low Stock Threshold',
                'track_inventory' => 'Track Inventory',
                'gallery' => 'Gallery',
                'sizes' => 'Available Sizes',
                'colors' => 'Available Colors',
                'color' => 'Color',
                'is_active' => 'Active',
                'is_featured' => 'Featured',
                'sales' => 'Sales',
                'add_size_placeholder' => 'Add new size',
                'add_size_helper' => 'Press Enter to add size',
            ],
        ],
        'order' => [
            'navigation_label' => 'Orders',
            'model_label' => 'Order',
            'plural_label' => 'Orders',
        ],
        'store' => [
            'navigation_label' => 'Stores',
            'model_label' => 'Store',
            'plural_label' => 'Stores',
        ],

        // Content Management
        'category' => [
            'navigation_label' => 'Categories',
            'model_label' => 'Category',
            'plural_label' => 'Categories',
        ],
        'blog' => [
            'navigation_label' => 'Blog Posts',
            'model_label' => 'Post',
            'plural_label' => 'Blog Posts',
        ],
        'page' => [
            'navigation_label' => 'Pages',
            'model_label' => 'Page',
            'plural_label' => 'Pages',
        ],
        'slider' => [
            'navigation_label' => 'Sliders',
            'model_label' => 'Slider',
            'plural_label' => 'Sliders',
        ],
        'banner' => [
            'navigation_label' => 'Banners',
            'model_label' => 'Banner',
            'plural_label' => 'Banners',
        ],
        'knight' => [
            'navigation_label' => 'Our Knights',
            'model_label' => 'Knight',
            'plural_label' => 'Our Knights',
            'fields' => [
                'name' => 'Name',
                'description' => 'Description',
                'image' => 'Image',
                'slug' => 'Slug',
                'link' => 'Read More Link (optional)',
                'sort_order' => 'Sort Order',
                'is_active' => 'Active',
            ],
        ],
        'sponsor' => [
            'navigation_label' => 'Sponsors',
            'model_label' => 'Sponsor',
            'plural_label' => 'Sponsors',
            'fields' => [
                'name' => 'Internal Name',
                'logo' => 'Logo',
                'website' => 'Website Link',
                'sort_order' => 'Sort Order',
                'is_active' => 'Active',
            ],
            'table' => [
                'order' => 'Order',
            ],
        ],
        'contact_message' => [
            'navigation_label' => 'Contact Messages',
            'model_label' => 'Message',
            'plural_label' => 'Contact Messages',
            'mark_read' => 'Mark as read',
        ],
        'information_page' => [
            'navigation_label' => 'Information About',
            'model_label' => 'Information Page',
            'plural_label' => 'Information About Pages',
            'sections' => [
                'basic_info' => 'Basic Information',
                'slider_images' => 'Slider Images',
                'extra_section' => 'Extra Section (Table / Slider)',
            ],
            'fields' => [
                'title' => 'Title',
                'slug' => 'Slug',
                'content' => 'Content',
                'template' => 'Page Template',
                'template_default' => 'Default',
                'template_with_table' => 'With Table (Digital Services)',
                'template_with_products_slider' => 'With Products Slider (Safety)',
                'template_with_sports_slider' => 'With Sports Slider',
                'is_active' => 'Active',
                'sort_order' => 'Sort Order',
                'extra_section_title' => 'Extra Section Title',
                'extra_section_content' => 'Extra Section Content',
                'table_data' => 'Table Data (for table template)',
                'table_type' => 'Type',
                'table_date' => 'Date',
                'table_time' => 'Time',
                'table_place' => 'Place',
                'table_details' => 'Details Link',
            ],
            'table' => [
                'title' => 'Title',
                'slug' => 'Slug',
                'template' => 'Template',
                'is_active' => 'Active',
                'sort_order' => 'Order',
                'updated_at' => 'Updated At',
            ],
        ],
        'equestrian_sport' => [
            'navigation_label' => 'Equestrian Sports',
            'model_label' => 'Equestrian Sport',
            'plural_label' => 'Equestrian Sports',
            'sections' => [
                'basic_info' => 'Basic Information',
                'image' => 'Card Image',
                'slider_images' => 'Page Slider Images',
            ],
            'fields' => [
                'title' => 'Title',
                'slug' => 'Slug',
                'content' => 'Content',
                'image' => 'Image',
                'slider_images' => 'Slider Images',
                'is_active' => 'Active',
                'sort_order' => 'Sort Order',
            ],
            'table' => [
                'title' => 'Title',
                'slug' => 'Slug',
                'sort_order' => 'Order',
                'is_active' => 'Active',
            ],
        ],
        'collaboration' => [
            'navigation_label' => 'Collaboration',
            'model_label' => 'Collaboration Item',
            'plural_label' => 'Collaboration',
            'sections' => [
                'basic_info' => 'Basic Information',
                'image' => 'Image',
            ],
            'fields' => [
                'title' => 'Title',
                'slug' => 'Slug',
                'description' => 'Description',
                'link_text' => 'Link Text',
                'image' => 'Image',
                'is_active' => 'Active',
                'sort_order' => 'Sort Order',
            ],
            'table' => [
                'title' => 'Title',
                'slug' => 'Slug',
                'sort_order' => 'Order',
                'is_active' => 'Active',
            ],
        ],
        'collaboration_request' => [
            'navigation_label' => 'Collaboration Requests',
            'model_label' => 'Collaboration Request',
            'plural_label' => 'Collaboration Requests',
            'table' => [
                'collaboration' => 'Collaboration',
                'name' => 'Name',
                'email' => 'Email',
                'phone' => 'Phone',
                'message' => 'Message',
                'created_at' => 'Date',
            ],
            'view' => [
                'details' => 'Details',
            ],
        ],

        // Users
        'user' => [
            'navigation_label' => 'Users',
            'model_label' => 'User',
            'plural_label' => 'Users',
        ],
    ],

    // Common Fields
    'fields' => [
        'name' => 'Name',
        'email' => 'Email',
        'phone' => 'Phone',
        'description' => 'Description',
        'address' => 'Address',
        'city' => 'City',
        'country' => 'Country',
        'status' => 'Status',
        'active' => 'Active',
        'featured' => 'Featured',
        'verified' => 'Verified',
        'price' => 'Price',
        'date' => 'Date',
        'time' => 'Time',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'subject' => 'Subject',
        'message' => 'Message',
        'read' => 'Read',

        // Booking fields
        'booking_number' => 'Booking Number',
        'customer' => 'Customer',
        'service' => 'Service',
        'horse' => 'Horse',
        'start_time' => 'Start Time',
        'end_time' => 'End Time',
        'duration' => 'Duration',
        'payment_status' => 'Payment Status',
        'payment_method' => 'Payment Method',
        'notes' => 'Notes',
        'customer_notes' => 'Customer Notes',
        'provider_notes' => 'Provider Notes',
        'cancellation_reason' => 'Cancellation Reason',

        // Trainer fields
        'user' => 'User',
        'stable' => 'Stable',
        'bio' => 'Bio',
        'specializations' => 'Specializations',
        'experience_years' => 'Years of Experience',
        'hourly_rate' => 'Hourly Rate',
        'rating' => 'Rating',
        'reviews_count' => 'Reviews Count',
        'students_count' => 'Students Count',
        'license_number' => 'License Number',
        'license_expiry' => 'License Expiry',
        'certificates' => 'Certificates',
        'photo' => 'Photo',

        // Store fields
        'owner' => 'Owner',
        'website' => 'Website',
        'logo' => 'Logo',
        'cover' => 'Cover',
        'gallery' => 'Gallery',

        // Section titles
        'basic_info' => 'Basic Information',
        'booking_info' => 'Booking Information',
        'timing' => 'Timing',
        'stats_status' => 'Stats & Status',
        'license' => 'License',
        'specializations_experience' => 'Specializations & Experience',
    ],

    // Pages (Site settings, etc.)
    'pages' => [
        'site_settings' => [
            'title' => 'Site Settings',
            'nav_label' => 'Site Settings',
            'contact_section' => 'Contact Details (Contact page)',
            'banner_heading' => 'Contact banner heading',
            'address' => 'Address',
            'working_hours' => 'Working hours',
            'logo_section' => 'Logo & Favicon',
            'logo' => 'Site logo',
            'favicon' => 'Favicon',
            'save_btn' => 'Save',
            'saved' => 'Settings saved successfully.',
        ],
    ],
];

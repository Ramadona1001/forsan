<?php

/**
 * Script to add translation methods to all Filament Resources
 * 
 * Usage: Copy the methods below and add them to each resource
 */

$translationMethods = '
    public static function getNavigationLabel(): string
    {
        return __("filament.resources.{RESOURCE_KEY}.navigation_label");
    }
    
    public static function getModelLabel(): string
    {
        return __("filament.resources.{RESOURCE_KEY}.model_label");
    }
    
    public static function getPluralModelLabel(): string
    {
        return __("filament.resources.{RESOURCE_KEY}.plural_label");
    }
    
    public static function getNavigationGroup(): ?string
    {
        return __("filament.navigation.{GROUP_KEY}");
    }
';

$resources = [
    // Service Resources (already done)
    'ServiceResource' => ['group' => 'services_management', 'key' => 'service', 'sort' => 1],
    'ServiceTabResource' => ['group' => 'services_management', 'key' => 'service_tab', 'sort' => 2],
    'ServicePackageResource' => ['group' => 'services_management', 'key' => 'service_package', 'sort' => 3],
    'BookingResource' => ['group' => 'services_management', 'key' => 'booking', 'sort' => 4],

    // Horse Resources
    'HorseResource' => ['group' => 'horses_management', 'key' => 'horse', 'sort' => 1], // Already done
    'StableResource' => ['group' => 'horses_management', 'key' => 'stable', 'sort' => 2],
    'TrainerResource' => ['group' => 'horses_management', 'key' => 'trainer', 'sort' => 3],

    // E-Commerce Resources
    'ProductResource' => ['group' => 'ecommerce', 'key' => 'product', 'sort' => 1],
    'OrderResource' => ['group' => 'ecommerce', 'key' => 'order', 'sort' => 2],
    'StoreResource' => ['group' => 'ecommerce', 'key' => 'store', 'sort' => 3],

    // Content Management Resources
    'CategoryResource' => ['group' => 'content_management', 'key' => 'category', 'sort' => 1],
    'BlogResource' => ['group' => 'content_management', 'key' => 'blog', 'sort' => 2],
    'PageResource' => ['group' => 'content_management', 'key' => 'page', 'sort' => 3],
    'SliderResource' => ['group' => 'content_management', 'key' => 'slider', 'sort' => 4],
    'BannerResource' => ['group' => 'content_management', 'key' => 'banner', 'sort' => 5],
    'SponsorResource' => ['group' => 'content_management', 'key' => 'sponsor', 'sort' => 6],

    // Users
    'UserResource' => ['group' => 'users_management', 'key' => 'user', 'sort' => 1],
];

echo "Resources to update:\n\n";
foreach ($resources as $name => $config) {
    echo "- $name:\n";
    echo "  Group: {$config['group']}\n";
    echo "  Key: {$config['key']}\n";
    echo "  Sort: {$config['sort']}\n\n";

    $methods = str_replace(['{RESOURCE_KEY}', '{GROUP_KEY}'], [$config['key'], $config['group']], $translationMethods);
    echo "Add these methods:\n";
    echo $methods . "\n";
    echo str_repeat('-', 50) . "\n\n";
}

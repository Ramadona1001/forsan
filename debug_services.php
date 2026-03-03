<?php

use App\Models\Category;
use App\Models\Service;

echo "--- Categories ---\n";
$categories = Category::all(['id', 'name', 'slug', 'parent_id']);
foreach ($categories as $cat) {
    echo "ID: {$cat->id}, Name: " . json_encode($cat->getTranslations('name')) . ", Slug: {$cat->slug}, Parent: {$cat->parent_id}\n";
}

echo "\n--- Services ---\n";
$services = Service::all(['id', 'name', 'slug', 'category_id', 'is_active']);
foreach ($services as $svc) {
    echo "ID: {$svc->id}, Name: {$svc->name}, Slug: {$svc->slug}, Cat ID: {$svc->category_id}, Active: {$svc->is_active}\n";
}

$targetSlug = 'horses-reviews-sub';
$targetCat = Category::where('slug', $targetSlug)->first();
if ($targetCat) {
    echo "\nTarget Category '{$targetSlug}' found. ID: {$targetCat->id}\n";
    $count = Service::where('category_id', $targetCat->id)->count();
    echo "Services count for this category: {$count}\n";
} else {
    echo "\nTarget Category '{$targetSlug}' NOT found.\n";
}

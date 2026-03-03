<?php

// Load Laravel application
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Category;
use App\Models\Service;

echo "Migrating Services...\n";

// Parent Category
$parent = Category::where('slug', 'horses-reviews')->first();
if (!$parent) {
    die("Parent horses-reviews not found.\n");
}

// Child Category
$child = Category::where('slug', 'horses-reviews-sub')->first();
if (!$child) {
    die("Child horses-reviews-sub not found. Please run seeder or generic fix.\n");
}

echo "Parent ID: {$parent->id}, Child ID: {$child->id}\n";

$count = Service::where('category_id', $parent->id)->count();
echo "Found {$count} services in Parent category.\n";

if ($count > 0) {
    Service::where('category_id', $parent->id)->update(['category_id' => $child->id]);
    echo "Moved {$count} services to Child category.\n";
} else {
    echo "No services to move.\n";
}

$newCount = Service::where('category_id', $child->id)->count();
echo "Total services in Child category now: {$newCount}\n";

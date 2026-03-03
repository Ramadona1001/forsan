<?php

// Load Laravel application
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Category;
use App\Models\Service;

echo "Refactoring Categories...\n";

// Parent Category
$parent = Category::where('slug', 'horses-reviews')->first();
if (!$parent) {
    // Attempt to find by ID 18 if slug was changed, or create it
    $parent = Category::find(18);
    if (!$parent) {
        echo "Parent category 'horses-reviews' not found. Creating it.\n";
        $parent = Category::create([
            'slug' => 'horses-reviews',
            'name' => ['ar' => 'استعراضات الخيل', 'en' => 'Horse Reviews'],
            'type' => 'service',
            'is_active' => true,
            'parent_id' => null
        ]);
    }
}

// Child Category
$child = Category::where('slug', 'horses-reviews-sub')->first();

if ($child) {
    echo "Found child category 'horses-reviews-sub' (ID: {$child->id}). Moving services to parent (ID: {$parent->id})...\n";

    // Move services
    $count = Service::where('category_id', $child->id)->update(['category_id' => $parent->id]);
    echo "Moved {$count} services to Parent category.\n";

    // Delete child
    $child->delete();
    echo "Deleted child category.\n";
} else {
    echo "Child category 'horses-reviews-sub' not found. Checking if services are already in parent...\n";
    $count = Service::where('category_id', $parent->id)->count();
    echo "Parent category has {$count} services.\n";
}

// Ensure parent has no parent
if ($parent->parent_id !== null) {
    $parent->update(['parent_id' => null]);
    echo "Ensured parent category is a root category.\n";
}

echo "Done.\n";

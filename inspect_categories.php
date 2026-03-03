<?php

// Load Laravel application
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Category;
use App\Models\Service;

echo "--- Categories Tree ---\n";
$roots = Category::whereNull('parent_id')->where('type', 'service')->get();

foreach ($roots as $root) {
    echo "Root: [{$root->id}] {$root->slug} (Name: " . json_encode($root->getTranslations('name')) . ")\n";
    $children = Category::where('parent_id', $root->id)->get();
    foreach ($children as $child) {
        echo "  Child: [{$child->id}] {$child->slug} (Name: " . json_encode($child->getTranslations('name')) . ")\n";

        $svcCount = Service::where('category_id', $child->id)->count();
        echo "    Services count: {$svcCount}\n";
    }

    $rootSvcCount = Service::where('category_id', $root->id)->count();
    echo "  Root Services count: {$rootSvcCount}\n";
}

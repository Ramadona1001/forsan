<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Product::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $owner = \App\Models\User::first();
        if (!$owner) {
            $owner = \App\Models\User::factory()->create();
        }

        $store = \App\Models\Store::firstOrCreate(
            ['owner_id' => $owner->id],
            ['name' => ['en' => 'Default Store', 'ar' => 'متجر افتراضي']]
        );

        // Products 1-4: Normal price
        for ($i = 1; $i <= 4; $i++) {
            $product = Product::create([
                'store_id' => $store->id,
                'name' => ['ar' => 'منتج ' . $i, 'en' => 'Product ' . $i],
                'price' => rand(100, 500),
                'description' => ['ar' => 'وصف للمنتج ' . $i, 'en' => 'Description for product ' . $i],
                'is_active' => true,
                'is_featured' => true,
                'stock' => 10,
            ]);

            $imagePath = public_path('images/products/' . $i . '.webp');
            if (file_exists($imagePath)) {
                $product->addMedia($imagePath)->preservingOriginal()->toMediaCollection('main_image');
            }
        }

        // Products 5-8: With Discount
        for ($i = 5; $i <= 8; $i++) {
            $price = rand(100, 500);
            $comparePrice = $price + rand(50, 200);

            $product = Product::create([
                'store_id' => $store->id,
                'name' => ['ar' => 'منتج مخفض ' . $i, 'en' => 'Discounted Product ' . $i],
                'price' => $price,
                'compare_price' => $comparePrice,
                'description' => ['ar' => 'وصف للمنتج المخفض ' . $i, 'en' => 'Description for discounted product ' . $i],
                'is_active' => true,
                'is_featured' => true,
                'stock' => 10,
            ]);

            $imagePath = public_path('images/products/' . $i . '.webp');
            if (file_exists($imagePath)) {
                $product->addMedia($imagePath)->preservingOriginal()->toMediaCollection('main_image');
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class UpdateProductsDataSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            return;
        }

        foreach ($products as $product) {
            $product->update([
                'name' => [
                    'ar' => 'اسم المنتج',
                    'en' => 'Product Name'
                ],
                'price' => 1000.00,
                'compare_price' => 1800.00,
                'description' => [
                    'ar' => 'لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبورأنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواسأيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايتنيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولبا',
                    'en' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
                ],
                'attributes' => [
                    'colors' => ['#FAEBD7', '#F0FFFF', '#F5F5DC', '#000000', '#8A2BE2', '#A52A2A', '#DEB887'],
                    'sizes' => ['34-XS', '36-S', '38-M', '40-L', '42-XL', '44-XXL']
                ],
                'stock' => 50,
                'is_active' => true,
            ]);
        }
    }
}

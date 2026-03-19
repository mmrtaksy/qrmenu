<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Kahvaltilar' => [
                ['name' => 'Serpme Kahvalti', 'description' => 'Zengin cesitleriyle geleneksel Turk kahvaltisi. Peynir, zeytin, bal, kaymak, recel, sucuk, simit ve daha fazlasi.', 'price' => 450],
                ['name' => 'Sahanda Yumurta', 'description' => 'Tereyaginda pisirilmis sahanda yumurta, yaninda taze ekmek ile.', 'price' => 120],
                ['name' => 'Menemen', 'description' => 'Domates, biber ve yumurta ile hazirlanan klasik menemen.', 'price' => 130],
            ],
            'Sicak Icecekler' => [
                ['name' => 'Turk Kahvesi', 'description' => 'Geleneksel yontemle pisirilmis Turk kahvesi.', 'price' => 60],
                ['name' => 'Latte', 'description' => 'Espresso ve kremali sut ile hazirlanan latte.', 'price' => 85],
                ['name' => 'Cappuccino', 'description' => 'Italyan usulu kopuklu cappuccino.', 'price' => 85],
                ['name' => 'Cay', 'description' => 'Demli Turk cayi.', 'price' => 25],
            ],
            'Soguk Icecekler' => [
                ['name' => 'Limonata', 'description' => 'Taze sikilmis ev yapimi limonata.', 'price' => 70],
                ['name' => 'Ice Latte', 'description' => 'Buzlu sut ve espresso.', 'price' => 95],
                ['name' => 'Smoothie', 'description' => 'Mevsim meyveleri ile hazirlanan smoothie.', 'price' => 110],
            ],
            'Tatlilar' => [
                ['name' => 'San Sebastian Cheesecake', 'description' => 'Kremali ve yogun lezzetli cheesecake.', 'price' => 140],
                ['name' => 'Tiramisu', 'description' => 'Klasik Italyan tiramisu.', 'price' => 130],
                ['name' => 'Sufle', 'description' => 'Sicak cikolatali sufle, dondurma ile servis edilir.', 'price' => 150],
            ],
            'Ana Yemekler' => [
                ['name' => 'Izgara Tavuk', 'description' => 'Marine edilmis tavuk gogsu, pilav ve salata ile.', 'price' => 220],
                ['name' => 'Kofte', 'description' => 'El yapimi izgara kofte, patates ve salata ile servis edilir.', 'price' => 200],
                ['name' => 'Makarna', 'description' => 'Kremali tavuklu penne makarna.', 'price' => 180],
            ],
        ];

        $sortOrder = 0;
        foreach ($data as $categoryName => $products) {
            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'sort_order' => $sortOrder++,
                'is_active' => true,
            ]);

            $productSort = 0;
            foreach ($products as $product) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $product['name'],
                    'slug' => Str::slug($product['name']),
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'sort_order' => $productSort++,
                    'is_active' => true,
                ]);
            }
        }
    }
}

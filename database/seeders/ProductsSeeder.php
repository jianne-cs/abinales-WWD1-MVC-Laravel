<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'MIKU EXPO 2025 ASIA Glowstick',
                'description' => 'Official MIKU EXPO 2025 glowstick with special lighting effects',
                'price' => 2140.00,
                'category' => 'Lightsticks',
                'image' => 'glowstick.jpg',
                'is_featured' => true,
                'stock' => 100
            ],
            [
                'name' => 'Knight Glowstick Film Set',
                'description' => 'Limited edition glowstick film set featuring knight design',
                'price' => 860.00,
                'category' => 'Lightsticks',
                'image' => 'glowstick-film.jpg',
                'is_featured' => false,
                'stock' => 50
            ],
            [
                'name' => 'Knight Happi Jacket',
                'description' => 'Traditional Japanese happi jacket with knight theme design',
                'price' => 3000.00,
                'category' => 'Apparel',
                'image' => 'happi-jacket.jpg',
                'is_featured' => true,
                'stock' => 75
            ],
            [
                'name' => 'March Tin Badge (Random / 6 types)',
                'description' => 'Collectible tin badges - get one random design from 6 available',
                'price' => 220.00,
                'category' => 'Accessories',
                'image' => 'tin-badge.jpg',
                'is_featured' => false,
                'stock' => 200
            ],
            [
                'name' => 'Horizon Muffler Towel',
                'description' => 'Premium muffler towel with horizon design, perfect for concerts',
                'price' => 1290.00,
                'category' => 'Accessories',
                'image' => 'muffler-towel.jpg',
                'is_featured' => false,
                'stock' => 80
            ],
            [
                'name' => 'Post Card Set (Set of 3)',
                'description' => 'Beautiful postcard set featuring 3 exclusive MIKU EXPO designs',
                'price' => 430.00,
                'category' => 'Stationery',
                'image' => 'postcard-set.jpg',
                'is_featured' => false,
                'stock' => 150
            ],
            [
                'name' => 'Horizon A3 Poster',
                'description' => 'Large A3 size poster with stunning horizon artwork',
                'price' => 650.00,
                'category' => 'Posters',
                'image' => 'a3-poster.jpg',
                'is_featured' => true,
                'stock' => 60
            ],
            [
                'name' => 'Knight Die Cut Sticker (6 types)',
                'description' => 'Set of 6 die-cut stickers featuring knight theme designs',
                'price' => 130.00,
                'category' => 'Stationery',
                'image' => 'die-cut-sticker.jpg',
                'is_featured' => false,
                'stock' => 300
            ],
            [
                'name' => 'Card Holder Photo Card Set (Set of 3)',
                'description' => 'Premium photo card set with card holder, includes 3 exclusive cards',
                'price' => 860.00,
                'category' => 'Accessories',
                'image' => 'card-holder.jpg',
                'is_featured' => false,
                'stock' => 90
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert($product);
        }
    }
}
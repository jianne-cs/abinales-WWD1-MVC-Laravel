<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PhilippineOrdersSeeder extends Seeder
{
    public function run()
    {
        // Get all customers and products
        $customers = DB::table('customers')->get();
        $products = DB::table('products')->get();

        $orderStatuses = ['pending', 'processing', 'completed', 'shipped', 'delivered'];
        $paymentMethods = ['gcash', 'maya', 'credit_card', 'bank_transfer', 'cash_on_delivery'];

        // Vocaloid-themed purchased items descriptions
        $vocaloidItemTypes = [
            'Official', 'Limited Edition', 'Concert Exclusive', 'Fan-made', 'Custom',
            'Special Edition', 'Anniversary', 'Collaboration', 'Premium', 'Rare'
        ];
        
        $vocaloidItemCategories = [
            'Glowstick', 'Poster', 'Figure', 'Keychain', 'T-shirt', 'Hoodie',
            'Album', 'Photobook', 'Badge', 'Sticker', 'Wall Scroll', 'Acrylic Stand',
            'Canvas Print', 'Phone Case', 'Lanyard', 'Tote Bag', 'Pin', 'Art Print'
        ];

        foreach ($customers as $customer) {
            // Each customer gets 1-5 orders
            $orderCount = rand(1, 5);
            $allPurchasedItems = [];
            
            for ($j = 0; $j < $orderCount; $j++) {
                $orderDate = Carbon::now()->subDays(rand(1, 90));
                $status = $orderStatuses[array_rand($orderStatuses)];
                
                // Create order
                $orderId = DB::table('orders')->insertGetId([
                    'customer_id' => $customer->id,
                    'total_amount' => 0, // Will calculate below
                    'status' => $status,
                    'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                    'shipping_address' => $customer->address,
                    'created_at' => $orderDate,
                    'updated_at' => $orderDate,
                ]);

                // Add 1-5 items to each order
                $orderTotal = 0;
                $itemsCount = rand(1, 5);
                $purchasedItems = [];

                for ($k = 0; $k < $itemsCount; $k++) {
                    $product = $products[rand(0, count($products) - 1)];
                    $quantity = rand(1, 3);
                    $itemTotal = $product->price * $quantity;
                    $orderTotal += $itemTotal;

                    DB::table('order_items')->insert([
                        'order_id' => $orderId,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'unit_price' => $product->price,
                        'created_at' => $orderDate,
                        'updated_at' => $orderDate,
                    ]);

                    $purchasedItems[] = $product->name . " (x{$quantity})";
                }

                // Update order total
                DB::table('orders')
                    ->where('id', $orderId)
                    ->update(['total_amount' => $orderTotal]);

                // Add some Vocaloid-themed purchased items
                $vocaloidItemsCount = rand(1, 3);
                for ($v = 0; $v < $vocaloidItemsCount; $v++) {
                    $vocaloidType = $vocaloidItemTypes[array_rand($vocaloidItemTypes)];
                    $vocaloidCategory = $vocaloidItemCategories[array_rand($vocaloidItemCategories)];
                    $vocaloidNames = ['Hatsune Miku', 'Kagamine Rin', 'Kagamine Len', 'Megurine Luka', 'Kaito', 'Meiko', 'Gumi', 'Gakupo', 'Teto Kasane'];
                    $vocaloidName = $vocaloidNames[array_rand($vocaloidNames)];
                    
                    $vocaloidItem = "{$vocaloidType} {$vocaloidName} {$vocaloidCategory}";
                    $allPurchasedItems[] = $vocaloidItem . " (x" . rand(1, 2) . ")";
                }

                $allPurchasedItems = array_merge($allPurchasedItems, $purchasedItems);
            }

            // Store purchased items in customer notes (mix of MIKU EXPO and Vocaloid items)
            if (!empty($allPurchasedItems)) {
                // Shuffle and take 3-6 random items to display
                shuffle($allPurchasedItems);
                $displayItems = array_slice($allPurchasedItems, 0, rand(3, 6));
                
                DB::table('customers')
                    ->where('id', $customer->id)
                    ->update([
                        'purchased_items' => implode(', ', $displayItems),
                        'updated_at' => Carbon::now()
                    ]);
            }
        }

        $this->command->info('✅ Orders and Vocaloid-themed items created for all customers!');
    }
}
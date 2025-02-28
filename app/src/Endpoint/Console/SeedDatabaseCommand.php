<?php

declare(strict_types=1);

namespace App\Endpoint\Console;

use Cycle\ORM\ORM;
use Spiral\Console\Attribute\AsCommand;
use Spiral\Console\Command;
use Cycle\Database\DatabaseProviderInterface;

#[AsCommand(name: 'db:seed', description: 'Seed the database')]
final class SeedDatabaseCommand extends Command
{
    public function __invoke(ORM $orm, DatabaseProviderInterface $db): int
    {
        $this->info('Seeding database...');
        $this->perform($orm, $db);
        $this->info('Database seeded successfully!');

        return self::SUCCESS;
    }

    public function perform(ORM $orm, DatabaseProviderInterface $db): void
    {
        $database = $db->database('default');

        // Insert Regions
        $regions = [
            ['region_id' => 1, 'region_name' => 'North America'],
            ['region_id' => 2, 'region_name' => 'Europe'],
            ['region_id' => 3, 'region_name' => 'Asia'],
            ['region_id' => 4, 'region_name' => 'South America'],
            ['region_id' => 5, 'region_name' => 'Australia'],
        ];
        $database->insert('regions')->values($regions)->run();

        // Insert Stores (20+ stores)
        $stores = [];
        for ($i = 1; $i <= 20; $i++) {
            $stores[] = [
                'store_id' => $i,
                'region_id' => rand(1, 5),
                'store_name' => "Store $i"
            ];
        }
        $database->insert('stores')->values($stores)->run();

        // Insert Categories (10+ categories)
        $categories = [
            ['category_id' => 1, 'category_name' => 'Electronics'],
            ['category_id' => 2, 'category_name' => 'Clothing'],
            ['category_id' => 3, 'category_name' => 'Home Appliances'],
            ['category_id' => 4, 'category_name' => 'Books'],
            ['category_id' => 5, 'category_name' => 'Toys'],
            ['category_id' => 6, 'category_name' => 'Automotive'],
            ['category_id' => 7, 'category_name' => 'Sports'],
            ['category_id' => 8, 'category_name' => 'Beauty'],
            ['category_id' => 9, 'category_name' => 'Furniture'],
            ['category_id' => 10, 'category_name' => 'Health'],
        ];
        $database->insert('categories')->values($categories)->run();

        // Insert Products (50+ products)
        $products = [];
        for ($i = 1; $i <= 50; $i++) {
            $products[] = [
                'product_id' => $i,
                'category_id' => rand(1, 10),
                'product_name' => "Product $i"
            ];
        }
        $database->insert('products')->values($products)->run();

        // Insert Users (Customers)
        $users = [];
        for ($i = 1; $i <= 50; $i++) {
            $users[] = [
                'id' => $i,
                'username' => "User $i",
                'email' => "user$i@example.com",
            ];
        }
        $database->insert('users')->values($users)->run();

        // Insert Orders (100+ orders)
        $orders = [];
        for ($i = 1; $i <= 100; $i++) {
            $orders[] = [
                'customer_id' => rand(1, 50),
                'store_id' => rand(1, 20),
                'order_date' => date('Y-m-d', strtotime("-" . rand(1, 365) . " days")),
            ];
        }
        $database->insert('orders')->values($orders)->run();

        // Insert Order Items (200+ order items)
        $orderItems = [];
        for ($i = 1; $i <= 200; $i++) {
            $orderItems[] = [
                'order_id' => rand(1, 100),
                'product_id' => rand(1, 50),
                'quantity' => rand(1, 5),
                'unit_price' => rand(5, 500) * 1.0,
            ];
        }
        $database->insert('order_items')->values($orderItems)->run();
    }
}

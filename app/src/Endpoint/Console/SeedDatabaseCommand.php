<?php

declare(strict_types=1);

namespace App\Endpoint\Console;

use Cycle\ORM\ORM;
use Spiral\Console\Attribute\Argument;
use Spiral\Console\Attribute\AsCommand;
use Spiral\Console\Attribute\Option;
use Spiral\Console\Attribute\Question;
use Spiral\Console\Command;
use Cycle\Database\DatabaseProviderInterface;

#[AsCommand(name: 'db:seed', description: 'Seed the database')]
final class SeedDatabaseCommand extends Command
{
    public function __invoke(): int
    {
        // Put your command logic here
        $this->info('Command logic is not implemented yet');

        return self::SUCCESS;
    }

    public function perform(ORM $orm, DatabaseProviderInterface $db): void
    {
        echo  "Hi Mariam!"; exit;
        $database = $db->database('default');

        // Insert Users
        $database->insert('users')->values([
            ['id' => 1, 'username' => 'John Doe', 'email' => 'john@doe.com'],
            ['id' => 2, 'username' => 'Jane Smith', 'email' => 'jane@example.com'],
        ])->run();

        // Insert Regions
        $database->insert('regions')->values([
            ['region_id' => 1, 'region_name' => 'North America'],
            ['region_id' => 2, 'region_name' => 'Europe'],
        ])->run();

        // Insert Stores
        $database->insert('stores')->values([
            ['store_id' => 1, 'region_id' => 1, 'store_name' => 'Store A'],
            ['store_id' => 2, 'region_id' => 2, 'store_name' => 'Store B'],
        ])->run();

        // Insert Categories
        $database->insert('categories')->values([
            ['category_id' => 1, 'category_name' => 'Electronics'],
            ['category_id' => 2, 'category_name' => 'Clothing'],
        ])->run();

        // Insert Products
        $database->insert('products')->values([
            ['product_id' => 1, 'category_id' => 1, 'product_name' => 'Laptop'],
            ['product_id' => 2, 'category_id' => 2, 'product_name' => 'T-Shirt'],
        ])->run();

        // Insert Orders
        $database->insert('orders')->values([
            ['customer_id' => 1, 'store_id' => 1, 'order_date' => '2024-01-15'],
            ['customer_id' => 2, 'store_id' => 2, 'order_date' => '2024-01-20'],
        ])->run();

        // Insert Order Items
        $database->insert('order_items')->values([
            ['order_id' => 1, 'product_id' => 1, 'quantity' => 1, 'unit_price' => 1000.00],
            ['order_id' => 2, 'product_id' => 2, 'quantity' => 3, 'unit_price' => 20.00],
        ])->run();


        $this->info('Database seeded successfully!');
    }
}

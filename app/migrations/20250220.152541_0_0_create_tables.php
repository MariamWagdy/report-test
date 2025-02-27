<?php


declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class CreateTables extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        // Regions Table
        $this->table('regions')
            ->addColumn('region_id', 'bigPrimary', ['nullable' => false, 'defaultValue' => null])
            ->addColumn('region_name', 'string', ['nullable' => false, 'length' => 200])
            ->setPrimaryKeys(['region_id'])
            ->create();

        // Categories Table
        $this->table('categories')
            ->addColumn('category_id', 'bigPrimary', ['nullable' => false, 'defaultValue' => null])
            ->addColumn('category_name', 'string', ['nullable' => false, 'length' => 200])
            ->setPrimaryKeys(['category_id'])
            ->create();

        // Order Items Table
        $this->table('order_items')
            ->addColumn('order_item_id', 'bigPrimary', ['nullable' => false, 'defaultValue' => null])
            ->addColumn('order_id', 'bigInteger', ['nullable' => false, 'defaultValue' => null])
            ->addColumn('product_id', 'bigInteger', ['nullable' => false, 'defaultValue' => null])
            ->addColumn('quantity', 'integer', ['nullable' => false, 'defaultValue' => 1])
            ->addColumn('unit_price', 'decimal', ['nullable' => false, 'precision' => 10, 'scale' => 2])
            ->setPrimaryKeys(['order_item_id'])
            ->addForeignKey(['order_id'], 'orders', ['order_id'], [
                'name' => 'order_items_order_id_fk',
                'delete' => 'CASCADE',
                'update' => 'CASCADE',
                'indexCreate' => true,
            ])
            ->addForeignKey(['product_id'], 'products', ['product_id'], [
                'name' => 'order_items_product_id_fk',
                'delete' => 'CASCADE',
                'update' => 'CASCADE',
                'indexCreate' => true,
            ])
            ->create();

        // Foreign Keys for Existing Tables
        $this->table('stores')
            ->addForeignKey(['region_id'], 'regions', ['region_id'], [
                'name' => 'stores_region_id_fk',
                'delete' => 'CASCADE',
                'update' => 'CASCADE',
                'indexCreate' => true,
            ])
            ->update();

        $this->table('products')
            ->addForeignKey(['category_id'], 'categories', ['category_id'], [
                'name' => 'products_category_id_fk',
                'delete' => 'CASCADE',
                'update' => 'CASCADE',
                'indexCreate' => true,
            ])
            ->update();
    }

    public function down(): void
    {
        $this->database()->execute('SET FOREIGN_KEY_CHECKS = 0;');
        $this->table('order_items')->drop();
        // Now it's safe to drop orders
        $this->table('orders')->drop();
        $this->table('categories')->drop();
        $this->table('regions')->drop();
        $this->database()->execute('SET FOREIGN_KEY_CHECKS = 1;');
    }
}

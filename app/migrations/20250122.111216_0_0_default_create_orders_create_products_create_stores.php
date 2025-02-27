<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefaultBaea8475f53fb941e7457e8d11dbd0ef extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('stores')
        ->addColumn('store_id', 'bigPrimary', ['nullable' => false, 'defaultValue' => null])
        ->addColumn('region_id', 'bigInteger', ['nullable' => false, 'defaultValue' => null])
        ->addColumn('store_name', 'string', ['nullable' => false, 'defaultValue' => null, 'length' => 200, 'size' => 255])
        ->setPrimaryKeys(['store_id'])
        ->create();
        $this->table('products')
        ->addColumn('product_id', 'bigPrimary', ['nullable' => false, 'defaultValue' => null])
        ->addColumn('category_id', 'bigInteger', ['nullable' => false, 'defaultValue' => null])
        ->addColumn('product_name', 'string', ['nullable' => false, 'defaultValue' => null, 'length' => 200, 'size' => 255])
        ->setPrimaryKeys(['product_id'])
        ->create();
        $this->table('orders')
        ->addColumn('order_id', 'bigPrimary', ['nullable' => false, 'defaultValue' => null])
        ->addColumn('customer_id', 'bigInteger', ['nullable' => false, 'defaultValue' => null])
        ->addColumn('order_date', 'date', ['nullable' => false, 'defaultValue' => null])
        ->addColumn('store_id', 'bigInteger', ['nullable' => false, 'defaultValue' => null])
            ->addIndex(['store_id'], ['name' => 'idx_orders_store_id']) // Adding index
        ->setPrimaryKeys(['order_id'])
        ->create();
    }

    public function down(): void
    {
        $this->table('orders')->drop();
        $this->table('products')->drop();
        $this->table('stores')->drop();
    }
}

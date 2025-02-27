<?php

declare(strict_types=1);

namespace App\Entity;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\BelongsTo;
#[Entity(table: 'order_items')]
class OrderItem
{
    #[Column(type: 'primary')]
    public int $id;

    #[Column(type: 'bigInteger')]
    public int $order_id;

    #[Column(type: 'bigInteger')]
    public int $product_id;

    #[Column(type: 'integer')]
    public int $quantity;

    #[Column(type: 'decimal', precision: 10, scale: 2)]
    public float $unit_price;

    #[BelongsTo(target: Order::class, innerKey: 'order_id', outerKey: 'order_id', nullable: false, fkAction: 'CASCADE')]
    public Order $order; // Each OrderItem belongs to an Order

    #[BelongsTo(target: Product::class, innerKey: 'product_id', outerKey: 'product_id', nullable: false, fkAction: 'CASCADE')]
    public Product $product;  // Each OrderItem belongs to product

}

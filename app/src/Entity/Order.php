<?php

declare(strict_types=1);

namespace App\Entity;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\BelongsTo;
use Cycle\Annotated\Annotation\Relation\HasMany;


#[Entity(table: 'orders')]
class Order
{
    #[Column(type: 'bigPrimary')]
    public int $orderId;

    #[Column(type: 'bigInteger')]
    public int $customerId;

    #[Column(type: 'date')]
    public \DateTimeInterface $orderDate;

    #[Column(type: 'bigInteger')]
    public int $storeId;

    #[BelongsTo(target: Store::class, innerKey: 'store_id', outerKey: 'store_id')]
    public Store $store;

    #[HasMany(target: OrderItem::class, innerKey: 'order_id', outerKey: 'order_id')]
    public array $orderItems;

    public function toArray(): array
    {
        return [
            'orderId' => $this->orderId,
            'customerId' => $this->customerId,
            'orderDate' => $this->orderDate,
            'storeId' => $this->storeId,
        ];
    }
}

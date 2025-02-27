<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Report\Repository\ReportRepositoryInterface;
use App\Entity\Order;
use App\Entity\OrderItem;
use Cycle\ORM\ORMInterface;

class CycleORMReportRepository implements ReportRepositoryInterface
{

    private ORMInterface $orm;

    public function __construct(ORMInterface $orm)
    {
        $this->orm = $orm;
    }

    public function getMonthlySalesByRegion(): array
    {
        $Query = "SELECT YEAR(order_date)                                     AS year,
                           MONTH(order_date)                                  AS month,
                           stores.region_id                                   AS region_id,
                           SUM(order_items.quantity * order_items.unit_price) AS total_sales_amount,
                           COUNT(orders.order_id)                             AS number_of_orders
                    FROM orders
                             INNER JOIN stores ON stores.store_id = orders.store_id
                             INNER JOIN order_items ON order_items.order_id = orders.order_id
                    GROUP BY YEAR(order_date), MONTH(order_date), stores.region_id";
        $source = $this->orm->getSource(Order::class);
        $db = $source->getDatabase();
        return $db->query($Query)->fetchAll();
    }

    public function getTopCategoriesByStore(string $startDate, string $endDate): array
    {
        $Query = "SELECT stores.store_id,
                       products.category_id,
                       SUM(order_items.quantity * order_items.unit_price)                                                                AS total_sales_amount,
                       DENSE_RANK() OVER (PARTITION BY stores.store_id ORDER BY SUM(order_items.quantity * order_items.unit_price) DESC) AS category_rank
                    FROM order_items
                             INNER JOIN orders ON orders.order_id = order_items.order_id
                             INNER JOIN products ON products.product_id = order_items.product_id
                             INNER JOIN stores ON stores.store_id = orders.store_id
                    WHERE orders.order_date BETWEEN :start_date AND :end_date
                    GROUP BY stores.store_id, products.category_id";
        $source = $this->orm->getSource(OrderItem::class);
        $db = $source->getDatabase();
        return $db->query($Query, [
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d')
        ])->fetchAll();
    }
}

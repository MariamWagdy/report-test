<?php

declare(strict_types=1);

namespace App\Domain\Report\Repository;

interface ReportRepositoryInterface
{
    public function getMonthlySalesByRegion(): array;

    public function getTopCategoriesByStore(string $startDate, string $endDate): array;
}

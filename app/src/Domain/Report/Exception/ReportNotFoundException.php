<?php

declare(strict_types=1);

namespace App\Domain\Report\Exception;

use RuntimeException;

class ReportNotFoundException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct("Report not found.");
    }
}

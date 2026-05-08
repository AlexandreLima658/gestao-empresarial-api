<?php

namespace App\Domain\Repositories\Financial;

use App\Domain\Entities\Financial\FinancialEntry;
use Illuminate\Support\Collection;

interface FinancialEntryRepository
{
    public function save(FinancialEntry $entry): FinancialEntry;

    public function findByPeriod(int $enterpriseId, string $startDate, string $endDate): Collection;
}

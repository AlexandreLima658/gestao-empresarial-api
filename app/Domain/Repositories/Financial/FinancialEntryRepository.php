<?php

namespace App\Domain\Repositories\Financial;

use App\Domain\Entities\Financial\FinancialEntry;

interface FinancialEntryRepository
{
    public function save(FinancialEntry $entry): FinancialEntry;
}

<?php

namespace App\Domain\Entities\Financial;

use App\Domain\Enums\FinancialEntryType;

class FinancialEntryFactory
{
    public static function create(
        int $id,
        int $enterpriseId,
        int $costCenterId,
        string $description,
        float $amount,
        FinancialEntryType $type,
        string $entryDate,

    ): FinancialEntry {
        return new FinancialEntry(
            $id,
            $enterpriseId,
            $costCenterId,
            $description,
            $amount,
            $type,
            $entryDate
        );
    }

    public static function createWithIdNull(
        int $enterpriseId,
        int $costCenterId,
        string $description,
        float $amount,
        FinancialEntryType $type,
        string $entryDate,

    ): FinancialEntry {
        return new FinancialEntry(
            null,
            $enterpriseId,
            $costCenterId,
            $description,
            $amount,
            $type,
            $entryDate
        );
    }
}

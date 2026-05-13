<?php

namespace App\Presenters;

use App\Application\UseCases\Financial\create\CreateFinancialOutput;

class FinancialEntryPresenter
{
    public static function toResponse(CreateFinancialOutput $entry): array
    {
        return [
            'id' => $entry->id,
            'description' => $entry->description,
            'amount' => $entry->amount,
            'type' => $entry->type,
        ];
    }
}

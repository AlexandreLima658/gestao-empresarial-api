<?php

namespace App\Application\UseCases\Financial\create;

use App\Domain\Enums\FinancialEntryType;

readonly class CreateFinancialOutput
{
    public function __construct(
        public int $id,
        public string $description,
        public float $amount,
        public FinancialEntryType $type,
    ){}


}

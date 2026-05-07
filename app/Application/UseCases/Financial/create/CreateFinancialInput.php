<?php

namespace App\Application\UseCases\Financial\create;

use App\Domain\Enums\FinancialEntryType;
use Illuminate\Http\Request;

readonly class CreateFinancialInput
{
    public function __construct(
        public int $enterprise_id,
        public int $cost_center_id,
        public string $description,
        public float $amount,
        public FinancialEntryType $type,
        public string $entryDate
    ) {}

    public static function from(Request $request): self
    {
        return new self(
            $request->input('enterprise_id'),
            $request->input('cost_center_id'),
            $request->input('description'),
            $request->input('amount'),
            FinancialEntryType::from($request->input('type')),
            $request->input('entry_date')
        );
    }

}

<?php

namespace App\Application\UseCases\CostCenter\create;

use Illuminate\Http\Request;

readonly class CreateCostCenterInput
{

    public function __construct(
        public int $enterpriseId,
        public string $name,
    )
    {}

    public static function from(Request $request): self
    {
        return new self(
            $request->input('enterprise_id'),
            $request->input('name')
        );
    }
}

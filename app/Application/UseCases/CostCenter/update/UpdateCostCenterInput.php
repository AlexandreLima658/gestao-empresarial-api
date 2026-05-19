<?php

namespace App\Application\UseCases\CostCenter\update;

use Illuminate\Http\Request;

readonly class UpdateCostCenterInput
{

    public function __construct(
        public int $id,
        public string $name,
    ){}

    public static function from(int $id, Request $request): self
    {
        return new self(
            $id,
            $request ->input('name')
        );

    }
}

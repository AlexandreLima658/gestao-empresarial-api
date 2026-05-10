<?php

namespace App\Application\UseCases\Monthly;



use Illuminate\Http\Request;

readonly class CloseMonthlyCashFlowInput
{
    public function __construct(
        public int $enterpriseId,
        public int $month,
        public int $year,
    ){}

    public static function from(Request $request): self
    {
        return new self(
            $request->input('enterprise_id'),
            $request->input('month'),
            $request->input('year')
        );
    }
}

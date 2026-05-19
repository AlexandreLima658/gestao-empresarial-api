<?php

namespace App\Application\UseCases\Monthly;

readonly class CloseMonthlyCashFlowOutput
{
    public function __construct(
        public int $enterpriseId,
        public int $month,
        public int $year,
    ){}
}

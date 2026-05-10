<?php

namespace App\Application\UseCases\Monthly;

use App\Domain\Entities\Monthly\ValueObject\Month;

readonly class CloseMonthlyCashFlowOutput
{
    public function __construct(
        public int $enterpriseId,
        public int $month,
        public int $year,
    ){}
}

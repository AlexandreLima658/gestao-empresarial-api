<?php

namespace App\Application\UseCases\CostCenter\create;

class CreateCostCenterOutput
{

    public function __construct(
        public int $costCenterId,
        public int $enterpriseId,
        public string $name,
    )
    {}
}

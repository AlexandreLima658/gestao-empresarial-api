<?php

namespace App\Application\UseCases\CostCenter\update;

class UpdateCostCenterOutput
{

    public function __construct(
        public int $id,
        public string $name,
    )
    {}
}

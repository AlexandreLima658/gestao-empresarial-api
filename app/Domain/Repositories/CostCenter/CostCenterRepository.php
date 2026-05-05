<?php

namespace App\Domain\Repositories\CostCenter;



use App\Domain\Entities\CostCenter\CostCenter;

interface CostCenterRepository
{
    public function save(CostCenter $costCenter): CostCenter;
}

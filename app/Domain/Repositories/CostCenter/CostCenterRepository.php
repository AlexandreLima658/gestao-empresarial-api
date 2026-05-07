<?php

namespace App\Domain\Repositories\CostCenter;



use App\Domain\Entities\CostCenter\CostCenter;
use Illuminate\Support\Collection;

interface CostCenterRepository
{
    public function save(CostCenter $costCenter): CostCenter;
    public function findEnterpriseById(int $enterpriseId): Collection;
    public function existsByNameAndEnterpriseId(string $name, int $enterpriseId): bool;
}




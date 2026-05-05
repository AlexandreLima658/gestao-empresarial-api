<?php

namespace App\Domain\Entities\CostCenter;

class CostCenterFactory
{
    public static function create(int $id, int $enterpriseId, string $name): CostCenter
    {
        return new CostCenter(
            $id,
            $enterpriseId,
            $name
        );
    }

    public static function createWithIdNull(int $enterpriseId, string $name): CostCenter
    {
        return new CostCenter(null, $enterpriseId, $name);
    }
}

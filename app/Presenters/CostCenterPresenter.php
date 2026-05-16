<?php

namespace App\Presenters;

use App\Application\UseCases\CostCenter\create\CreateCostCenterOutput;
use App\Domain\Entities\CostCenter\CostCenter;
use Illuminate\Support\Collection;

class CostCenterPresenter
{
    public static function toJson(CostCenter $costCenter): array
    {
        return [
            'id' => $costCenter->getId(),
            'enterprise_id' => $costCenter->getEnterpriseId(),
            'name' => $costCenter->getName(),
        ];
    }

    public static function toResponse(CreateCostCenterOutput $cost): array
    {
        return [
            'id' => $cost->costCenterId,
            'enterprise_id' => $cost->enterpriseId,
            'name' => $cost->name,
        ];
    }

    public static function collection(Collection $costCenters): Collection
    {
        return $costCenters->map(fn($item) => self::toJson($item));
    }
}

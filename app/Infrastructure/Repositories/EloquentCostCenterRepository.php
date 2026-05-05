<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\CostCenter\CostCenter;
use App\Domain\Entities\CostCenter\CostCenterFactory;
use App\Domain\Repositories\CostCenter\CostCenterRepository;
use App\Models\CostCenterModel;

class EloquentCostCenterRepository implements CostCenterRepository
{

    public function save(CostCenter $costCenter): CostCenter
    {
        $model = CostCenterModel::create([
           'enterprise_id' => $costCenter->getEnterpriseId(),
           'name' => $costCenter->getName(),
        ]);

       return $this->mapper($model);
    }

    public function mapper(CostCenterModel $model): CostCenter
    {
        return CostCenterFactory::create(
            $model->id,
            $model->enterprise_id,
            $model->name
        );
    }


}

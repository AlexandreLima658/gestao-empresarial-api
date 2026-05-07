<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\CostCenter\CostCenter;
use App\Domain\Entities\CostCenter\CostCenterFactory;
use App\Domain\Repositories\CostCenter\CostCenterRepository;
use App\Models\CostCenterModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

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

    public function findEnterpriseById(int $enterpriseId): Collection
    {
        return CostCenterModel::query()
            ->where('enterprise_id', $enterpriseId)
            ->get()
            ->map(fn($model) => $this->mapper($model));
    }

    public function existsByNameAndEnterpriseId(string $name, int $enterpriseId): bool
    {
        return CostCenterModel::query()
            ->where('enterprise_id', $enterpriseId)
            ->where('name', $name)
            ->exists();
    }
    public function findById(int $id): ?CostCenter
    {
        $model = CostCenterModel::query()->find($id);
        return $model ? $this->mapper($model) : null;
    }

    public function update(CostCenter $costCenter): CostCenter
    {
        $model = CostCenterModel::query()->find($costCenter->getId());

        if(!$model) {
            throw new \Exception("Cost center not found");
        }

        $model->update([
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

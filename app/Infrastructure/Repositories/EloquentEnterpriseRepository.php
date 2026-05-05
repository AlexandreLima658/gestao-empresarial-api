<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Enterprise;
use App\Domain\Repositories\EnterpriseRepository;
use App\Models\EnterpriseModel;
use Override;

class EloquentEnterpriseRepository implements EnterpriseRepository
{
    public function save(Enterprise $enterprise): Enterprise
    {
        $model = EnterpriseModel::create([
            'name' => $enterprise->getName()
        ]);

         return $this->mapper($model);

    }

    public function findAll(): array
    {
        return EnterpriseModel::all()
            ->map(fn($model) => $this->mapper($model))
            ->toArray();
    }


    public function findById(int $id): ?Enterprise
    {
        $model = EnterpriseModel::findOrFail($id);

        return $model ? $this->mapper($model) : null;

    }


    public function update(Enterprise $enterprise): Enterprise
    {
        $model = EnterpriseModel::findOrFail($enterprise->getId());

        if(!$model) {
            throw new \Exception('Enterprise not found');
        }

        $model->update([
            'name' => $enterprise->getName()
        ]);

        return $this->mapper($model);
    }


    private function mapper(EnterpriseModel $model): Enterprise
    {
        return new Enterprise(
            $model->id,
            $model->name
        );
    }

}

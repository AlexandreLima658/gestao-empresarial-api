<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Enterprise\Enterprise;
use App\Domain\Repositories\Enterprise\EnterpriseRepository;
use App\Models\EnterpriseModel;

class EloquentEnterpriseRepository implements EnterpriseRepository
{
    public function __construct(
        private EnterpriseModel $enterpriseModel
    )
    {}

    public function save(Enterprise $enterprise): Enterprise
    {
        $model = $this->enterpriseModel
                ->query()
                ->create([
                    'name' => $enterprise->getName()
                ]);

        return $this->mapper($model);

    }

    public function findById(int $id): ?Enterprise
    {
        $model = $this->enterpriseModel
            ->query()
            ->find($id);

        return $model ? $this->mapper($model) : null;

    }

    public function update(Enterprise $enterprise): Enterprise
    {
        $model = EnterpriseModel::query()->find($enterprise->getId());

        if(!$model) {
            throw new \Exception('Enterprise not found');
        }

        $model->update([
            'name' => $enterprise->getName()
        ]);

        return $this->mapper($model);
    }

    public function delete(int $id): void
    {
       $model = $this->enterpriseModel
            ->query()
            ->find($id);

       if(!$model) {
           throw new \Exception('Enterprise not found');
       }

       $model->delete();
    }

    private function mapper(EnterpriseModel $model): Enterprise
    {
        return new Enterprise(
            $model->id,
            $model->name
        );
    }

}

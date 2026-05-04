<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Enterprise;
use App\Domain\Repositories\EnterpriseRepository;
use App\Models\EnterpriseModel;

class EloquentEnterpriseRepository implements EnterpriseRepository
{
    public function salve(Enterprise $enterprise): Enterprise
    {
        $model = EnterpriseModel::create([
            'name' => $enterprise->getName()
        ]);

        return new Enterprise(
            $model->id,
            $model->name
        );

    }

    public function list(): array
    {
        return EnterpriseModel::all()
            ->map(function ($model) {
               return new Enterprise(
                    $model->id,
                    $model->name
               );
            })->toArray();
    }

}

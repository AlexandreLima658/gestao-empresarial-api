<?php

namespace App\Presenters;

use App\Application\UseCases\Enterprise\create\CreateEnterpriseOutput;
use App\Application\UseCases\Enterprise\retrieve\Filter\RetrieveEnterprisesOutput;
use App\Application\UseCases\Enterprise\update\UpdateEnterpriseOutput;
use App\Domain\Commons\Pagination\Pagination;
use App\Domain\Entities\Enterprise\Enterprise;

class EnterprisePresenter
{
    public static function toJson(Enterprise $enterprise): array
    {
        return [
            'id' => $enterprise->getId(),
            'name' => $enterprise->getName()
        ];
    }

    public static function toJsonCreate(CreateEnterpriseOutput $enterprise): array
    {
        return [
            'id' => $enterprise->id,
            'name' => $enterprise->name
        ];
    }

    public static function toJsonUpdate(UpdateEnterpriseOutput $enterprise): array
    {
        return [
            'id' => $enterprise->id,
            'name' => $enterprise->name
        ];
    }

    private static function output(RetrieveEnterprisesOutput $output): array
    {
        return [
            'id' => $output->id,
            'name' => $output->name,
        ];
    }

    public static function present(Pagination $pagination): array
    {
        return [
            'current_page' => $pagination->currentPage,
            'per_page' => $pagination->perPage,
            'total' => $pagination->total,
            'items' => array_map(
                fn($item) => self::output($item),
                $pagination->items
            )
        ];
    }
}

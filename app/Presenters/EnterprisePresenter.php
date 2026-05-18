<?php

namespace App\Presenters;

use App\Application\UseCases\Enterprise\create\CreateEnterpriseOutput;
use App\Domain\Entities\Enterprise\Enterprise;

class EnterprisePresenter
{
    public static function toJson(CreateEnterpriseOutput $enterprise): array
    {
        return [
            'id' => $enterprise->id,
            'name' => $enterprise->name
        ];
    }

    public static function collection(array $enterprises): array
    {
        return array_map(
            fn($enterprise) => self::toJson($enterprise),
            $enterprises
        );
    }
}

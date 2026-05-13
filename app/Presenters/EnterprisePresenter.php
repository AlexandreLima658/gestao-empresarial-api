<?php

namespace App\Presenters;

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

    public static function collection(array $enterprises): array
    {
        return array_map(
            fn($enterprise) => self::toJson($enterprise),
            $enterprises
        );
    }
}

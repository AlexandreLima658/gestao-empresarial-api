<?php

namespace App\Domain\Entities\Enterprise;

class EnterpriseFactory
{
    public static function create(int $id, string $name): Enterprise
    {
        return new Enterprise(
            $id,
            $name
        );
    }

    public static function createWithIdNull(string $name): Enterprise
    {
        return new Enterprise(null, $name);
    }
}

<?php

namespace App\Application\UseCases\Enterprise\update;

readonly class UpdateEnterpriseOutput
{

    public function __construct(
        public int $id,
        public string $name,
    )
    {}
}

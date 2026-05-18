<?php

namespace App\Application\UseCases\Enterprise\create;

class CreateEnterpriseOutput
{
    public function __construct(
        public int $id,
        public string $name
    ){}
}

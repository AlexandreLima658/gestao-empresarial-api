<?php

namespace App\Application\UseCases\Enterprise\retrieve\Filter;

readonly class RetrieveEnterprisesOutput
{
    public function __construct(
        public int $id,
        public string $name,
    )
    {}
}

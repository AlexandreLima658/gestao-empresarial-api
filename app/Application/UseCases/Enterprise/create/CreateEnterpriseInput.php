<?php

namespace App\Application\UseCases\Enterprise\create;

readonly class CreateEnterpriseInput
{

    public function __construct(
        public string $name
    ){}

    public static function from($request): self
    {
        return new self(
            $request->input('name')
        );
    }
}

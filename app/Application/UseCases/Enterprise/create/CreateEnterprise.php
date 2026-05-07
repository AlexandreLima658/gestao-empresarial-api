<?php

namespace App\Application\UseCases\Enterprise\create;

use App\Domain\Entities\Enterprise\Enterprise;
use App\Domain\Repositories\Enterprise\EnterpriseRepository;

class CreateEnterprise
{
    private EnterpriseRepository $repository;

    public function __construct(EnterpriseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $name): Enterprise
    {
        $enterprise = new Enterprise(null, $name);
        return $this->repository->save($enterprise);
    }
}

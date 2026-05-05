<?php

namespace App\Application\UseCases\Enterprise\retrieve;

use App\Domain\Repositories\EnterpriseRepository;

class RetrieveEnterprise
{
    private EnterpriseRepository $repository;

    public function __construct(EnterpriseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): array
    {
        return $this->repository->findAll();
    }
}

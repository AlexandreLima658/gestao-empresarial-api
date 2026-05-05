<?php

namespace App\Application\UseCases\Enterprise\retrieve;

use App\Domain\Entities\Enterprise;
use App\Domain\Repositories\EnterpriseRepository;

class RetrieveEnterpriseById
{
    private EnterpriseRepository $repository;

    public function __construct(EnterpriseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id): Enterprise
    {
        $enterprise = $this->repository->findById($id);

        if(!$enterprise) {
            throw new \Exception("Enterprise not found");
        }

        return $enterprise;
    }
}

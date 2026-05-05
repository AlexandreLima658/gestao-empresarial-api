<?php

namespace App\Application\UseCases\Enterprise\update;

use App\Domain\Entities\Enterprise;
use App\Domain\Repositories\EnterpriseRepository;

class UpdateEnterprise
{
    private EnterpriseRepository $repository;

    public function __construct(EnterpriseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id, string $name): Enterprise
    {
        $enterprise = $this->repository->findById($id);

        if(!$enterprise){
            throw new \Exception("Enterprise not found!");
        }

        $enterprise->updateEnterprise($name);

        return $this->repository->update($enterprise);
    }
}

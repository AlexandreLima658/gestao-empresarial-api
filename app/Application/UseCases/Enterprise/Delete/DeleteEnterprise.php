<?php

namespace App\Application\UseCases\Enterprise\Delete;

use App\Domain\Repositories\EnterpriseRepository;

class DeleteEnterprise
{
    private EnterpriseRepository $enterpriseRepository;

    public function __construct(EnterpriseRepository $enterpriseRepository)
    {
        $this->enterpriseRepository = $enterpriseRepository;
    }

    public function execute(int $id): void
    {
        $this->enterpriseRepository->delete($id);
    }
}

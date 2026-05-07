<?php

namespace App\Application\UseCases\CostCenter\delete;

use App\Domain\Entities\CostCenter\CostCenter;
use App\Domain\Repositories\CostCenter\CostCenterRepository;

class DeleteCostCenter
{
    private CostCenterRepository $costCenterRepository;
    public function __construct(
        CostCenterRepository $costCenterRepository
    ) {
        $this->costCenterRepository = $costCenterRepository;
    }

    public function execute(int $id): void
    {
        $this->costCenterRepository->delete($id);
    }
}

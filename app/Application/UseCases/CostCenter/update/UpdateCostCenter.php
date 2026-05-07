<?php

namespace App\Application\UseCases\CostCenter\update;

use App\Domain\Entities\CostCenter\CostCenter;
use App\Domain\Repositories\CostCenter\CostCenterRepository;


class UpdateCostCenter
{

    public function __construct(
        private CostCenterRepository $costCenterRepository
    ) {}
    public function execute(int $id, string $name): CostCenter {
        $costCenter = $this->costCenterRepository->findById($id);

        if(!$costCenter) {
            throw new \Exception("Cost center not found");
        }

        $alreadyExits = $this->costCenterRepository->existsByNameAndEnterpriseId(
            $name,
            $costCenter->getEnterpriseId()
        );

        if($alreadyExits && $costCenter->getName() !== $name) {
            throw new \Exception("Cost center already exists for enterprise");
        }
        $costCenter->updateName($name);

        return $this->costCenterRepository->update($costCenter);

    }

}

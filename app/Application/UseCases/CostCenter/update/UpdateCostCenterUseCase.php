<?php

namespace App\Application\UseCases\CostCenter\update;

use App\Application\UseCases\UseCase;
use App\Domain\Entities\CostCenter\CostCenter;
use App\Domain\Repositories\CostCenter\CostCenterRepository;


/**
 * @extends UseCase<UpdateCostCenterInput, UpdateCostCenterOutput>
 */
class UpdateCostCenterUseCase extends UseCase
{
    private CostCenterRepository $costCenterRepository;
    public function __construct(
        CostCenterRepository $costCenterRepository
    ) {
        $this->costCenterRepository = $costCenterRepository;
    }

    /**
     * @param UpdateCostCenterInput $input
     * @return UpdateCostCenterOutput
     */
    public function execute($input): UpdateCostCenterOutput
    {
        $costCenter = $this->costCenterRepository->findById($input->id);

        if(!$costCenter) {
            throw new \Exception("Cost center not found");
        }

        $alreadyExits = $this->costCenterRepository->existsByNameAndEnterpriseId(
            $input->name,
            $costCenter->getEnterpriseId()
        );

        if($alreadyExits && $costCenter->getName() !== $input->name) {
            throw new \Exception("Cost center already exists for enterprise");
        }
        $costCenter->updateName($input->name);

        $model = $this->costCenterRepository->update($costCenter);

        return new UpdateCostCenterOutput(
            $model->getId(),
            $model->getName()
        );

    }

}

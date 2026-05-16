<?php

namespace App\Application\UseCases\CostCenter\create;

use App\Application\UseCases\UseCase;
use App\Domain\Entities\CostCenter\CostCenterFactory;
use App\Domain\Repositories\CostCenter\CostCenterRepository;
use App\Domain\Repositories\Enterprise\EnterpriseRepository;

/**
 * @extends UseCase<CreateCostCenterInput, CreateCostCenterOutput>
 */
class CreateCostCenterUseCase extends UseCase
{
    private CostCenterRepository $costCenterRepository;
    private EnterpriseRepository $enterpriseRepository;

    /**
     * @param CostCenterRepository $costCenterRepository
     * @param EnterpriseRepository $enterpriseRepository
     */
    public function __construct(
        CostCenterRepository $costCenterRepository,
        EnterpriseRepository $enterpriseRepository
    )
    {
        $this->costCenterRepository = $costCenterRepository;
        $this->enterpriseRepository = $enterpriseRepository;
    }

    /**
     * @param CreateCostCenterInput $input
     * @return CreateCostCenterOutput
     */
    public function execute($input): CreateCostCenterOutput
    {

        $enterprise = $this->enterpriseRepository
            ->findById($input->enterpriseId);

        if(!$enterprise){
            throw new \Exception("Enterprise not found");
        }

        $alreadyExists = $this->costCenterRepository
            ->existsByNameAndEnterpriseId(
                $input->name,
                $input->enterpriseId
            );

        if ($alreadyExists) {
            throw new \Exception("Cost Center already exists for enterprise");
        }

        $costCenter = CostCenterFactory::createWithIdNull(
            $input->enterpriseId,
            $input->name
        );

        $costCenterModel = $this->costCenterRepository->save($costCenter);

        return new CreateCostCenterOutput(
            $costCenterModel->getId(),
            $costCenterModel->getEnterpriseId(),
            $costCenterModel->getName(),
        );
    }

}

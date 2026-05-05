<?php

namespace App\Application\UseCases\CostCenter\create;

use App\Domain\Entities\CostCenter\CostCenter;
use App\Domain\Entities\CostCenter\CostCenterFactory;
use App\Domain\Repositories\CostCenter\CostCenterRepository;
use App\Domain\Repositories\Enterprise\EnterpriseRepository;

class CreateCostCenter
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

    public function execute(int $enterpriseId, string $name): CostCenter
    {

        $enterprise = $this->enterpriseRepository->findById($enterpriseId);

        if(!$enterprise){
            throw new \Exception("Enterprise not found");
        }

        $costCenter = CostCenterFactory::createWithIdNull($enterpriseId, $name);

        return $this->costCenterRepository->save($costCenter);

    }

}

<?php

namespace App\Application\UseCases\CostCenter\retrieve;

use App\Domain\Repositories\CostCenter\CostCenterRepository;
use App\Domain\Repositories\Enterprise\EnterpriseRepository;
use Illuminate\Support\Collection;

class RetrieveCostCenterByEnterprise
{
    private EnterpriseRepository $enterpriseRepository;
    private CostCenterRepository $costCenterRepository;

    /**
     * @param EnterpriseRepository $enterpriseRepository
     * @param CostCenterRepository $costCenterRepository
     */
    public function __construct(
        EnterpriseRepository $enterpriseRepository,
        CostCenterRepository $costCenterRepository
    )
    {
        $this->enterpriseRepository = $enterpriseRepository;
        $this->costCenterRepository = $costCenterRepository;
    }

    public function execute(int $enterpriseId): Collection
    {
        $enterprise = $this->enterpriseRepository->findById($enterpriseId);

        if(!$enterprise){
            throw new \Exception("Enterprise not found");
        }

        return $this->costCenterRepository->findEnterpriseById($enterpriseId);

    }

}

<?php

namespace App\Application\UseCases\Financial\create;

use App\Application\UseCases\UseCase;
use App\Domain\Entities\Financial\FinancialEntryFactory;
use App\Domain\Repositories\CostCenter\CostCenterRepository;
use App\Domain\Repositories\Enterprise\EnterpriseRepository;
use App\Domain\Repositories\Financial\FinancialEntryRepository;

/**
 * @extends UseCase<CreateFinancialInput, CreateFinancialOutput>
 */
class CreateFinancialEntry extends UseCase
{
    private FinancialEntryRepository $repository;
    private CostCenterRepository $costCenterRepository;
    private EnterpriseRepository $enterpriseRepository;

    /**
     * @param FinancialEntryRepository $repository
     * @param CostCenterRepository $costCenterRepository
     * @param EnterpriseRepository $enterpriseRepository
     */
    public function __construct(
        FinancialEntryRepository $repository,
        CostCenterRepository $costCenterRepository,
        EnterpriseRepository $enterpriseRepository)
    {
        $this->repository = $repository;
        $this->costCenterRepository = $costCenterRepository;
        $this->enterpriseRepository = $enterpriseRepository;
    }

    /**
     * @param CreateFinancialInput $input
     * @return CreateFinancialOutput
     */
    public function execute($input): CreateFinancialOutput
    {
        $model = FinancialEntryFactory::createWithIdNull(
            $input->enterprise_id,
            $input->cost_center_id,
            $input->description,
            $input->amount,
            $input->type,
            $input->entryDate
        );

        $modelId = $this->repository->save($model);
        return new CreateFinancialOutput($modelId->getId());
    }
}

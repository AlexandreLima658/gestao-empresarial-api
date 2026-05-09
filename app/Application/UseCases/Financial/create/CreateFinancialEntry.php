<?php

namespace App\Application\UseCases\Financial\create;

use App\Application\UseCases\UseCase;
use App\Domain\Entities\Financial\FinancialEntryFactory;
use App\Domain\Repositories\CostCenter\CostCenterRepository;
use App\Domain\Repositories\Enterprise\EnterpriseRepository;
use App\Domain\Repositories\Financial\FinancialEntryRepository;
use App\Domain\Repositories\Monthly\MonthlyClosingRepository;

/**
 * @extends UseCase<CreateFinancialInput, CreateFinancialOutput>
 */
class CreateFinancialEntry extends UseCase
{
    private FinancialEntryRepository $repository;
    private CostCenterRepository $costCenterRepository;
    private EnterpriseRepository $enterpriseRepository;
    private MonthlyClosingRepository $monthlyClosingRepository;

    /**
     * @param FinancialEntryRepository $repository
     * @param CostCenterRepository $costCenterRepository
     * @param EnterpriseRepository $enterpriseRepository
     * @param MonthlyClosingRepository $monthlyClosingRepository
     */
    public function __construct(
        FinancialEntryRepository $repository,
        CostCenterRepository     $costCenterRepository,
        EnterpriseRepository     $enterpriseRepository,
        MonthlyClosingRepository $monthlyClosingRepository
    )
    {
        $this->repository = $repository;
        $this->costCenterRepository = $costCenterRepository;
        $this->enterpriseRepository = $enterpriseRepository;
        $this->monthlyClosingRepository = $monthlyClosingRepository;
    }

    /**
     * @param CreateFinancialInput $input
     * @return CreateFinancialOutput
     */
    public function execute($input): CreateFinancialOutput
    {

        $date = new \DateTime($input->entryDate);
        $month = (int) $date->format('m');
        $year = (int) $date->format('Y');

        $closing = $this->monthlyClosingRepository->findByPeriod(
            $input->enterprise_id,
            $month,
            $year
        );

        if($closing && $closing->isClosed()){
            throw new \Exception("Month closed for new releases");
        }

        $entry = FinancialEntryFactory::createWithIdNull(
            $input->enterprise_id,
            $input->cost_center_id,
            $input->description,
            $input->amount,
            $input->type,
            $input->entryDate
        );

        $model = $this->repository->save($entry);

        return new CreateFinancialOutput(
            $model->getId(),
            $model->getDescription(),
            $model->getAmount(),
            $model->getType(),
        );
    }
}

<?php

namespace App\Application\UseCases\Monthly;


use App\Application\UseCases\UseCase;
use App\Domain\Entities\Monthly\MonthlyClosingFactory;
use App\Domain\Entities\Monthly\ValueObject\Month;
use App\Domain\Repositories\Enterprise\EnterpriseRepository;
use App\Domain\Repositories\Monthly\MonthlyClosingRepository;

/**
 * @extends UseCase<CloseMonthlyCashFlowInput, CloseMonthlyCashFlowOutput>
 */
class CloseMonthlyCashFlow extends UseCase
{
    private MonthlyClosingRepository $repository;
    private EnterpriseRepository $enterpriseRepository;

    /**
     * @param MonthlyClosingRepository $repository
     * @param EnterpriseRepository $enterpriseRepository
     */
    public function __construct(
        MonthlyClosingRepository $repository,
        EnterpriseRepository $enterpriseRepository
    )
    {
        $this->repository = $repository;
        $this->enterpriseRepository = $enterpriseRepository;
    }

    /**
     * @param CloseMonthlyCashFlowInput $input
     * @return CloseMonthlyCashFlowOutput
     * @throws \Exception
     */
    public function execute($input): CloseMonthlyCashFlowOutput
    {
        $enterprise = $this->enterpriseRepository->findById($input->enterpriseId);
        if(!$enterprise){
            throw new \Exception("Enterprise not found!");
        }

        $alreadyClosed = $this->repository->findByPeriod(
            $input->enterpriseId,
            $input->month,
            $input->year
        );

        if($alreadyClosed){
            throw new \Exception("Already closed!");
        }

        $closing = MonthlyClosingFactory::createWithIdNull(
            $input->enterpriseId,
            $input->month,
            $input->year,
            true
        );

       $closeModel = $this->repository->save($closing);

        return new CloseMonthlyCashFlowOutput(
            $closeModel->getEnterpriseId(),
            Month::from($closeModel->getMonth()),
            $closeModel->getYear(),
        );
    }
}

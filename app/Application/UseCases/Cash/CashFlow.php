<?php

namespace App\Application\UseCases\Cash;

use App\Domain\Enums\FinancialEntryType;
use App\Domain\Repositories\Enterprise\EnterpriseRepository;
use App\Domain\Repositories\Financial\FinancialEntryRepository;
use Illuminate\Support\Collection;

class CashFlow
{
    private FinancialEntryRepository $repository;
    private EnterpriseRepository $enterpriseRepository;

    /**
     * @param FinancialEntryRepository $repository
     * @param EnterpriseRepository $enterpriseRepository
     */
    public function __construct(
        FinancialEntryRepository $repository,
        EnterpriseRepository $enterpriseRepository
    )
    {
        $this->repository = $repository;
        $this->enterpriseRepository = $enterpriseRepository;
    }

    public function execute(int $enterpriseId, string $startDate, string $endDate) : Collection
    {
        $enterprise = $this->enterpriseRepository->findById($enterpriseId);

        if(!$enterprise){
            throw new \Exception("Enterprise not found!");
        }

        $entries = $this->repository->findByPeriod($enterpriseId, $startDate, $endDate);

        $totalIncome = 0;
        $totalExpense = 0;

        foreach ($entries as $entry) {
            if($entry->getType() === FinancialEntryType::INCOME){
                $totalIncome += $entry->getAmount();
            }
            if($entry->getType() === FinancialEntryType::EXPENSE){
                $totalExpense += $entry->getAmount();
            }
        }

        return collect([
            'total_income' => $totalIncome,
            'total_expense' => $totalExpense,
            'balance' => $totalIncome - $totalExpense
        ]);
    }

}

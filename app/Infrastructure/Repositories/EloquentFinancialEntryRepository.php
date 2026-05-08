<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Financial\FinancialEntry;
use App\Domain\Enums\FinancialEntryType;
use App\Domain\Repositories\Financial\FinancialEntryRepository;
use App\Models\FinancialEntryModel;
use Illuminate\Support\Collection;

class EloquentFinancialEntryRepository implements FinancialEntryRepository
{

    public function save(FinancialEntry $entry): FinancialEntry
    {
        $model = FinancialEntryModel::query()->create([
            'enterprise_id' => $entry->getEnterpriseId(),
            'cost_center_id' => $entry->getCostCenterId(),
            'description' => $entry->getDescription(),
            'amount' => $entry->getAmount(),
            'type' => $entry->getType(),
            'entry_date' => $entry->getEntryDate(),
        ]);

        return $this->mapper($model);
    }

    public function findByPeriod(int $enterpriseId, string $startDate, string $endDate): Collection
    {
        return FinancialEntryModel::query()
            ->where('enterprise_id', $enterpriseId)
            ->whereBetween('entry_date', [$startDate, $endDate])
            ->get()
            ->map(fn($model) => $this->mapper($model));

    }

    public function mapper(FinancialEntryModel $model): FinancialEntry
    {
        return new FinancialEntry(
            $model->id,
            $model->enterprise_id,
            $model->cost_center_id,
            $model->description,
            $model->amount,
            $model->type,
            $model->entry_date
        );
    }


}

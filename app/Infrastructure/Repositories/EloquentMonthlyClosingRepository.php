<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Monthly\MonthlyClosing;
use App\Domain\Entities\Monthly\ValueObject\Month;
use App\Domain\Repositories\Monthly\MonthlyClosingRepository;
use App\Models\MonthlyClosingModel;

class EloquentMonthlyClosingRepository implements MonthlyClosingRepository
{

    public function save(MonthlyClosing $closing): MonthlyClosing
    {
        $model =  MonthlyClosingModel::query()->create([
            'enterprise_id' => $closing->getEnterpriseId(),
            'month' => $closing->getMonth()->value(),
            'year' => $closing->getYear(),
            'closed' => $closing->isClosed(),
        ]);

        return $this->mapper($model);
    }

    public function findByPeriod(int $enterprise, int $month, int $year): ?MonthlyClosing
    {
        $model =  MonthlyClosingModel::query()
            ->where('enterprise_id', $enterprise)
            ->where('month', $month)
            ->where('year', $year)
            ->first();

        return !$model ? null : $this->mapper($model);
    }

    public function mapper(MonthlyClosingModel $model): MonthlyClosing
    {
        return new MonthlyClosing(
            $model->id,
            $model->enterprise_id,
            Month::fromInt($model->month),
            $model->year,
            $model->closed
        );
    }
}

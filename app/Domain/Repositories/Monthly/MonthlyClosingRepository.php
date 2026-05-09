<?php

namespace App\Domain\Repositories\Monthly;

use App\Domain\Entities\Monthly\MonthlyClosing;

interface MonthlyClosingRepository
{
    public function save(MonthlyClosing $closing): MonthlyClosing;
    public function findByPeriod(int $enterprise, int $month, int $year): ?MonthlyClosing;
}

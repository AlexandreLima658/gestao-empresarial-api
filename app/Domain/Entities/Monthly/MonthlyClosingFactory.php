<?php

namespace App\Domain\Entities\Monthly;

use App\Domain\Entities\Monthly\ValueObject\Month;

class MonthlyClosingFactory
{

    public static function createWithIdNull(
        int $enterpriseId,
        int $month,
        int $year,
        bool $closed
    ): MonthlyClosing {
        return new MonthlyClosing(
            null,
            $enterpriseId,
            Month::fromInt($month),
            $year,
            $closed
        );
    }

}

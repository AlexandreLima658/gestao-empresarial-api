<?php

namespace App\Presenters;

class MonthlyClosingPresenter
{
    public static function toResponse($monthly): array
    {
        return [
            'enterprise_id' => $monthly->enterprise_id,
            'month' => $monthly->month,
            'year' => $monthly->year,
            'closed' => $monthly->closed,
        ];
    }
}

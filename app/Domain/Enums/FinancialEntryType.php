<?php

namespace App\Domain\Enums;

enum FinancialEntryType: string
{
    case INCOME = 'INCOME';
    case EXPENSE = 'EXPENSE';
}

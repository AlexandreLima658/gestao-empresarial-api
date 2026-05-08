<?php

namespace App\Models;

use App\Domain\Enums\FinancialEntryType;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $enterprise_id
 * @property int $cost_center_id
 * @property string $description
 * @property float $amount
 * @property string $type
 * @property string $entry_date
 */
class FinancialEntryModel extends Model
{
    protected $table = 'financial_entries';

    protected $fillable = [
        'enterprise_id',
        'cost_center_id',
        'description',
        'amount',
        'type',
        'entry_date',
    ];

    protected $casts = [
        'type' => FinancialEntryType::class,
        'amount' => 'decimal:2',
        'entry_date' => 'date',
    ];
}

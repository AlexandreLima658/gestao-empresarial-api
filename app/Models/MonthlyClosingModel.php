<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyClosingModel extends Model
{

    protected $table = 'monthly_closings';
    protected $fillable = [
        'enterprise_id',
        'month',
        'year',
        'closed'
    ];
}

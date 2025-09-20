<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetForecast extends Model
{
    protected $fillable = [
        'category', 'amount', 'month', 'reason','status'
    ];
}

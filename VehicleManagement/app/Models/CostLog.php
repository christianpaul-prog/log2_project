<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostLog extends Model
{
    //
 protected $table = 'cost_logs'; // optional kung pareho lang
    protected $fillable = [
       'cost_id',
        'vehicle',
        'category',
        'amount',
        'action',         // sino nag-close/report
    ];

}

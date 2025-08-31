<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
    // Laravel will automatically map this to "drivers" table
    protected $table = 'drivers';
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'age',
        'gender',
        'phone_number',
        'place_of_birth',
        'address',
        'nationality',
        'license_no',
    ];
    public function getFullNameAttribute()
    {
         $middleInitial = $this->middle_name ? strtoupper(substr($this->middle_name, 0, 1)) . '.' : '';
         return "{$this->first_name} {$middleInitial} {$this->last_name}";
    }
    public function dispatches()
    {
        return $this->hasMany(Dispatch::class, 'driver_id');
    }
}

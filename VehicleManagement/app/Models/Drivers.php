<?php

namespace App\Models;

use App\Http\Controllers\TripController;
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
   public function trips()
    {
        return $this->hasMany(Trip::class, 'driver_id', 'id');
    }
}

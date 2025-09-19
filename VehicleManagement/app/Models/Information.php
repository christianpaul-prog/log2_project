<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Information extends Model
{
    use HasFactory;

    protected $table = 'information'; 
    protected $fillable = [
        'license_no',
        'phone_number',
        'firstName',
        'middleName',
        'lastName',
        'age',
        'gender',
        'nationality',
        'birthPlace',
        'birthday',
        'address',
        'bio',
        'avatar',
        'driver_id',
    ];
public function getFullNameAttribute()
{
    $firstName  = ucfirst(strtolower($this->firstName));
    $lastName   = ucfirst(strtolower($this->lastName));
    $middleInitial = $this->middleName ? strtoupper(substr($this->middleName, 0, 1)) . '.' : '';

    return trim("{$firstName} {$middleInitial} {$lastName}");
}
    public function trips()
    {
        return $this->hasMany(Trip::class, 'information_id', 'id');
    }

public function getInitialsAttribute()
{
    $parts = [$this->firstName, $this->lastName]; // only first and last name
    $parts = array_filter($parts); // remove empty parts just in case

    $initials = '';
    foreach ($parts as $part) {
        $initials .= strtoupper(substr($part, 0, 1));
    }

    return $initials;
}
}

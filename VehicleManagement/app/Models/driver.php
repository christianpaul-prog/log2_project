<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class driver extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    public function information()
{
    return $this->hasOne(Information::class, 'driver_id');
}

    public function shifts()
    {
        return $this->hasMany(Shift::class, 'driver_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $table = 'flight';
    protected $primaryKey = 'flight_id';
    public $timestamps = false;

    public function passengers()
    {
        return $this->hasMany(Passenger::class, 'flight_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    protected $table = 'passenger';
    protected $primaryKey = 'passenger_id';
    public $timestamps = false;

    public function flight()
    {
        return $this->belongsTo(Flight::class, 'flight_id');
    }
}

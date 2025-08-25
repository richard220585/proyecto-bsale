<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchase';
    protected $primaryKey = 'purchase_id';

    public function flight()
    {
        return $this->belongsTo(Flight::class, 'flight_id');
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class, 'purchase_id');
    }
}

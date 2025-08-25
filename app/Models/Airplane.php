<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airplane extends Model
{
    protected $table = 'airplane';
    protected $primaryKey = 'airplane_id';

    public function flights()
    {
        return $this->hasMany(Flight::class, 'airplane_id');
    }

    public function seats()
    {
        return $this->hasMany(Seat::class, 'airplane_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeatType extends Model
{
    protected $table = 'seat_type';
    protected $primaryKey = 'seat_type_id';

    public function seats()
    {
        return $this->hasMany(Seat::class, 'seat_type_id');
    }
}

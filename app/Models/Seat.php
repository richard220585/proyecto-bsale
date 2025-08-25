<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $table = 'seat';
    protected $primaryKey = 'seat_id';

    public function seatType()
    {
        return $this->belongsTo(SeatType::class, 'seat_type_id');
    }

    public function airplane()
    {
        return $this->belongsTo(Airplane::class, 'airplane_id');
    }

    public function boardingPass()
    {
        return $this->hasOne(BoardingPass::class, 'seat_id');
    }
}

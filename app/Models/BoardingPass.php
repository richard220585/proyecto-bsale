<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoardingPass extends Model
{
    protected $table = 'boarding_pass';
    protected $primaryKey = 'boarding_pass_id';
    public $timestamps = false;

    public function flight()
    {
        return $this->belongsTo(Flight::class, 'flight_id');
    }
}

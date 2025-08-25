<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BoardingPass;

class BoardingPassController extends Controller
{
    public function getBoardingPasses($flightId)
    {
        $passes = BoardingPass::where('flight_id', $flightId)->get();
        return response()->json([
            'code' => 200,
            'data' => $passes
        ]);
    }
}

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flight;

class FlightController extends Controller
{
    public function show($id)
    {
        $flight = Flight::with(['passengers'])->findOrFail($id);

        return response()->json([
            'code' => 200,
            'data' => [
                'flightId' => $flight->flight_id,
                'takeoffDateTime' => strtotime($flight->takeoff_datetime),
                'takeoffAirport' => $flight->takeoff_airport,
                'landingDateTime' => strtotime($flight->landing_datetime),
                'landingAirport' => $flight->landing_airport,
                'airplaneId' => $flight->airplane_id,
                'passengers' => $flight->passengers->map(function($p) {
                    return [
                        'passengerId' => $p->passenger_id,
                        'dni' => $p->dni,
                        'name' => $p->name,
                        'age' => $p->age,
                        'country' => $p->country,
                        'boardingPassId' => $p->boarding_pass_id,
                        'purchaseId' => $p->purchase_id,
                        'seatTypeId' => $p->seat_type_id,
                        'seatId' => $p->seat_id,
                    ];
                }),
            ],
        ]);
    }
}

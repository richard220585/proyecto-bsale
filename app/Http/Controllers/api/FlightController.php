<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flight;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{
    // Mostrar un vuelo
    public function show($id)
    {
        $flight = Flight::find($id);
        if (!$flight) {
            return response()->json(['code' => 404, 'data' => new \stdClass()]);
        }

        return response()->json([
            'code' => 200,
            'data' => [
                'flightId' => $flight->flight_id,
                'takeoffDateTime' => $flight->takeoff_date_time,
                'takeoffAirport' => $flight->takeoff_airport,
                'landingDateTime' => $flight->landing_date_time,
                'landingAirport' => $flight->landing_airport,
                'airplaneId' => $flight->airplane_id
            ]
        ]);
    }

    // Mostrar pasajeros de un vuelo organizados por compra y adultos primero
    public function showPassengers($id)
    {
        $flight = Flight::find($id);
        if (!$flight) {
            return response()->json(['code' => 404, 'data' => new \stdClass()]);
        }

        // Obtenemos todos los pasajeros del vuelo
        $passengers = DB::table('passenger as p')
            ->join('boarding_pass as bp', 'bp.passenger_id', '=', 'p.passenger_id')
            ->leftJoin('seat as s', 's.seat_id', '=', 'bp.seat_id')
            ->select(
                'p.passenger_id as passengerId',
                'p.dni',
                'p.name',
                'p.age',
                'p.country',
                'bp.boarding_pass_id as boardingPassId',
                'bp.purchase_id as purchaseId',
                'bp.seat_type_id as seatTypeId',
                'bp.seat_id as seatId'
            )
            ->where('bp.flight_id', $id)
            ->orderBy('bp.purchase_id') // Agrupa por compra
            ->orderByDesc(DB::raw('p.age >= 18')) // Adultos primero dentro de la compra
            ->get();

        // Organizar pasajeros por purchaseId en un array para que menores estén con adultos
        $groupedPassengers = [];
        foreach ($passengers as $passenger) {
            $purchaseId = $passenger->purchaseId;
            if (!isset($groupedPassengers[$purchaseId])) {
                $groupedPassengers[$purchaseId] = [];
            }
            $groupedPassengers[$purchaseId][] = $passenger;
        }

        // Convertir a array plano con la organización por compras
        $organizedPassengers = [];
        foreach ($groupedPassengers as $purchase) {
            foreach ($purchase as $passenger) {
                $organizedPassengers[] = $passenger;
            }
        }

        return response()->json([
            'code' => 200,
            'data' => [
                'flightId' => $flight->flight_id,
                'takeoffDateTime' => $flight->takeoff_date_time,
                'takeoffAirport' => $flight->takeoff_airport,
                'landingDateTime' => $flight->landing_date_time,
                'landingAirport' => $flight->landing_airport,
                'airplaneId' => $flight->airplane_id,
                'passengers' => $organizedPassengers
            ]
        ]);
    }

    // CRUD opcional (vacío)
    public function store(Request $request) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}

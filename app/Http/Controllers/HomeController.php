<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\BoardingHouse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cities = City::orderBy('name')->get();
        return view('home', compact('cities'));
    }

    public function listings(Request $request)
    {
        $cities = City::orderBy('name')->get();

        $query = BoardingHouse::with('city')->latest();

        // Filter by area (city)
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        // Filter by room type
        if ($request->filled('room_type')) {
            $query->where('room_type', $request->room_type);
        }

        // Filter by max budget
        if ($request->filled('budget')) {
            $query->where('price_per_month', '<=', $request->budget);
        }

        $boardingHouses = $query->get();

        $filters = [
            'city_id'   => $request->city_id,
            'room_type' => $request->room_type,
            'budget'    => $request->budget,
        ];

        return view('listings', compact('cities', 'boardingHouses', 'filters'));
    }
}
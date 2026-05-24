<?php

namespace App\Http\Controllers;

use App\Models\BoardingHouse;
use App\Models\City;
use Illuminate\Http\Request;

class BoardingHouseController extends Controller
{
    public function index()
    {
        $boardingHouses = BoardingHouse::with('city')
            ->latest()
            ->paginate(12);
        
        return view('boarding-houses.index', compact('boardingHouses'));
    }

    public function create()
    {
        $cities = City::orderBy('name')->get();
        return view('boarding-houses.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'city_id'         => 'required|exists:cities,id',
            'name'            => 'required|string|max:255',
            'description'     => 'nullable|string',
            'location'        => 'required|string|max:255',
            'room_type'       => 'required|in:single,shared',
            'total_beds'      => 'required|integer|min:1',
            'available_beds'  => 'required|integer|min:0|lte:total_beds',
            'size_sqm'        => 'nullable|numeric|min:1',
            'price_per_month' => 'required|numeric|min:0',
            'is_available'    => 'boolean',
            'rating'          => 'nullable|integer|min:1|max:5',
        ]);

        BoardingHouse::create($validated);

        return redirect('/listings')
            ->with('success', 'Boarding house added successfully!');
    }

    public function edit(BoardingHouse $boardingHouse)
    {
        $cities = City::orderBy('name')->get();
        return view('boarding-houses.edit', compact('boardingHouse', 'cities'));
    }

    public function update(Request $request, BoardingHouse $boardingHouse)
    {
        $validated = $request->validate([
            'city_id'         => 'required|exists:cities,id',
            'name'            => 'required|string|max:255',
            'description'     => 'nullable|string',
            'location'        => 'required|string|max:255',
            'room_type'       => 'required|in:single,shared',
            'total_beds'      => 'required|integer|min:1',
            'available_beds'  => 'required|integer|min:0|lte:total_beds',
            'size_sqm'        => 'nullable|numeric|min:1',
            'price_per_month' => 'required|numeric|min:0',
            'is_available'    => 'boolean',
            'rating'          => 'nullable|integer|min:1|max:5',
        ]);

        $boardingHouse->update($validated);

        return redirect('/listings')
            ->with('success', 'Boarding house updated successfully!');
    }

    public function destroy(BoardingHouse $boardingHouse)
    {
        $boardingHouse->delete();

        return redirect('/listings')
            ->with('success', 'Boarding house deleted successfully!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\BoardingHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    public function index()
    {
        $activeRentals = Rental::with('boardingHouse.city')
            ->where('status', 'active')
            ->latest()
            ->get();

        $pastRentals = Rental::with('boardingHouse.city')
            ->where('status', 'ended')
            ->latest()
            ->get();

        $totalActive = $activeRentals->count();
        $monthlyRevenue = $activeRentals->sum('price_per_month');

        return view('rent', compact('activeRentals', 'pastRentals', 'totalActive', 'monthlyRevenue'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'boarding_house_id' => 'required|exists:boarding_houses,id',
            'tenant_name'       => 'required|string|max:255',
            'tenant_email'      => 'nullable|email|max:255',
            'tenant_contact'    => 'nullable|string|max:20',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $house = BoardingHouse::lockForUpdate()->findOrFail($validated['boarding_house_id']);

                if ($house->available_beds <= 0) {
                    throw new \Exception('No beds available in this boarding house.');
                }

                Rental::create([
                    'boarding_house_id' => $house->id,
                    'tenant_name'       => $validated['tenant_name'],
                    'tenant_phone'      => $validated['tenant_contact'] ?? null,
                    'tenant_email'      => $validated['tenant_email'] ?? null,
                    'tenant_contact'    => $validated['tenant_contact'] ?? null,
                    'rental_date'       => now(),
                    'price_per_month'   => $house->price_per_month,
                    'status'            => 'active',
                ]);

                $house->decrement('available_beds');

                // If available beds become 0, make it unavailable
                if ($house->available_beds <= 0) {
                    $house->is_available = false;
                    $house->save();
                }
            });

            return redirect('/rent')->with('success', 'Room rented successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function endRental(Rental $rental)
    {
        if ($rental->status === 'ended') {
            return redirect('/rent')->with('error', 'This rental has already ended.');
        }

        try {
            DB::transaction(function () use ($rental) {
                $rental->status = 'ended';
                $rental->save();

                $house = BoardingHouse::lockForUpdate()->find($rental->boarding_house_id);
                if ($house) {
                    $house->increment('available_beds');
                    $house->is_available = true;
                    $house->save();
                }
            });

            return redirect('/rent')->with('success', 'Rental ended successfully. Bed is now available.');
        } catch (\Exception $e) {
            return redirect('/rent')->with('error', 'An error occurred while ending the rental.');
        }
    }
}

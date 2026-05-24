<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BoardingHouse;
use App\Models\Tenant;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $pendingBookings = Booking::with('boardingHouse.city')
            ->where('status', 'pending')
            ->latest()
            ->get();

        $allBookings = Booking::with('boardingHouse.city')
            ->where('status', '!=', 'pending')
            ->latest()
            ->get();

        return view('bookings.index', compact('pendingBookings', 'allBookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'boarding_house_id' => 'required|exists:boarding_houses,id',
            'tenant_name'       => 'required|string|max:255',
            'tenant_email'      => 'nullable|email|max:255',
            'tenant_contact'    => 'nullable|string|max:20',
            'room_number'       => 'nullable|string|max:50',
            'notes'             => 'nullable|string|max:1000',
        ]);

        $house = BoardingHouse::findOrFail($validated['boarding_house_id']);

        Booking::create([
            'boarding_house_id' => $validated['boarding_house_id'],
            'tenant_name'       => $validated['tenant_name'],
            'tenant_email'      => $validated['tenant_email'],
            'tenant_contact'    => $validated['tenant_contact'],
            'room_number'       => $validated['room_number'] ?? null,
            'status'            => 'pending',
            'notes'             => $validated['notes'] ?? null,
        ]);

        return redirect('/listings')->with('success', 'Your booking inquiry for "' . $house->name . '" has been submitted successfully! The host will review your request shortly.');
    }

    public function approve(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->with('error', 'This booking has already been processed.');
        }

        try {
            DB::transaction(function () use ($booking) {
                $house = BoardingHouse::lockForUpdate()->findOrFail($booking->boarding_house_id);

                if ($house->available_beds <= 0) {
                    throw new \Exception('No beds available in this boarding house.');
                }

                // 1. Update booking status
                $booking->status = 'approved';
                $booking->save();

                // 2. Create Tenant record
                Tenant::create([
                    'boarding_house_id' => $house->id,
                    'name'              => $booking->tenant_name,
                    'email'             => $booking->tenant_email,
                    'contact'           => $booking->tenant_contact,
                    'room_number'       => $booking->room_number ?? 'Bed',
                    'move_in_date'      => now()->toDateString(),
                    'status'            => 'active',
                ]);

                // 3. Decrement available beds
                $house->decrement('available_beds');
                if ($house->available_beds <= 0) {
                    $house->is_available = false;
                    $house->save();
                }

                // 4. Synchronize with legacy Rentals system to keep /rent and legacy tests working
                Rental::create([
                    'boarding_house_id' => $house->id,
                    'tenant_name'       => $booking->tenant_name,
                    'tenant_phone'      => $booking->tenant_contact ?? '—',
                    'tenant_email'      => $booking->tenant_email,
                    'tenant_contact'    => $booking->tenant_contact,
                    'rental_date'       => now(),
                    'price_per_month'   => $house->price_per_month,
                    'status'            => 'active',
                ]);
            });

            return redirect()->route('bookings.index')->with('success', 'Booking inquiry approved! Tenant created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function reject(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->with('error', 'This booking has already been processed.');
        }

        $booking->status = 'rejected';
        $booking->save();

        return redirect()->route('bookings.index')->with('success', 'Booking inquiry rejected.');
    }
}

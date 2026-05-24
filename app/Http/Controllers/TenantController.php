<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\BoardingHouse;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TenantController extends Controller
{
    public function index()
    {
        $activeTenants = Tenant::with('boardingHouse.city')
            ->where('status', 'active')
            ->latest()
            ->get();

        $pastTenants = Tenant::with('boardingHouse.city')
            ->where('status', 'moved_out')
            ->latest()
            ->get();

        return view('tenants.index', compact('activeTenants', 'pastTenants'));
    }

    public function create()
    {
        $boardingHouses = BoardingHouse::where('is_available', true)
            ->where('available_beds', '>', 0)
            ->get();

        return view('tenants.create', compact('boardingHouses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'boarding_house_id' => 'required|exists:boarding_houses,id',
            'name'              => 'required|string|max:255',
            'email'             => 'nullable|email|max:255',
            'contact'           => 'nullable|string|max:20',
            'room_number'       => 'nullable|string|max:50',
            'move_in_date'      => 'required|date',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $house = BoardingHouse::lockForUpdate()->findOrFail($validated['boarding_house_id']);

                if ($house->available_beds <= 0) {
                    throw new \Exception('No beds available in this boarding house.');
                }

                // 1. Create Tenant
                Tenant::create([
                    'boarding_house_id' => $house->id,
                    'name'              => $validated['name'],
                    'email'             => $validated['email'],
                    'contact'           => $validated['contact'],
                    'room_number'       => $validated['room_number'] ?? 'Bed',
                    'move_in_date'      => $validated['move_in_date'],
                    'status'            => 'active',
                ]);

                // 2. Decrement available beds
                $house->decrement('available_beds');
                if ($house->available_beds <= 0) {
                    $house->is_available = false;
                    $house->save();
                }

                // 3. Sync with legacy Rental system
                Rental::create([
                    'boarding_house_id' => $house->id,
                    'tenant_name'       => $validated['name'],
                    'tenant_phone'      => $validated['contact'] ?? '—',
                    'tenant_email'      => $validated['email'],
                    'tenant_contact'    => $validated['contact'],
                    'rental_date'       => $validated['move_in_date'] . ' 00:00:00',
                    'price_per_month'   => $house->price_per_month,
                    'status'            => 'active',
                ]);
            });

            return redirect()->route('tenants.index')->with('success', 'Tenant added successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit(Tenant $tenant)
    {
        return view('tenants.edit', compact('tenant'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'nullable|email|max:255',
            'contact'     => 'nullable|string|max:20',
            'room_number' => 'nullable|string|max:50',
        ]);

        $tenant->update($validated);

        // Also update details in the active legacy Rental record
        Rental::where('boarding_house_id', $tenant->boarding_house_id)
            ->where('tenant_name', $tenant->getOriginal('name'))
            ->where('status', 'active')
            ->update([
                'tenant_name'    => $validated['name'],
                'tenant_email'   => $validated['email'],
                'tenant_contact' => $validated['contact'],
                'tenant_phone'   => $validated['contact'] ?? '—',
            ]);

        return redirect()->route('tenants.index')->with('success', 'Tenant updated successfully!');
    }

    public function moveOut(Tenant $tenant)
    {
        if ($tenant->status === 'moved_out') {
            return back()->with('error', 'This tenant has already moved out.');
        }

        try {
            DB::transaction(function () use ($tenant) {
                $tenant->status = 'moved_out';
                $tenant->save();

                // Increment available beds
                $house = BoardingHouse::lockForUpdate()->find($tenant->boarding_house_id);
                if ($house) {
                    $house->increment('available_beds');
                    $house->is_available = true;
                    $house->save();
                }

                // End legacy Rental
                Rental::where('boarding_house_id', $tenant->boarding_house_id)
                    ->where('tenant_name', $tenant->name)
                    ->where('status', 'active')
                    ->update([
                        'status' => 'ended'
                    ]);
            });

            return redirect()->route('tenants.index')->with('success', 'Tenant moved out successfully. Bed has been released.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while moving out the tenant.');
        }
    }

    public function destroy(Tenant $tenant)
    {
        try {
            DB::transaction(function () use ($tenant) {
                if ($tenant->status === 'active') {
                    $house = BoardingHouse::lockForUpdate()->find($tenant->boarding_house_id);
                    if ($house) {
                        $house->increment('available_beds');
                        $house->is_available = true;
                        $house->save();
                    }

                    // End legacy Rental
                    Rental::where('boarding_house_id', $tenant->boarding_house_id)
                        ->where('tenant_name', $tenant->name)
                        ->where('status', 'active')
                        ->update([
                            'status' => 'ended'
                        ]);
                }

                $tenant->delete();
            });

            return redirect()->route('tenants.index')->with('success', 'Tenant deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while deleting the tenant.');
        }
    }
}

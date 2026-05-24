<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Tenant;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['tenant.boardingHouse']);

        if ($request->filled('tenant_id')) {
            $query->where('tenant_id', $request->tenant_id);
        }

        if ($request->filled('month')) {
            $query->where('month_covered', 'like', '%' . $request->month . '%');
        }

        if ($request->filled('method')) {
            $query->where('payment_method', $request->method);
        }

        $payments = $query->latest('payment_date')->latest('id')->get();
        $tenants = Tenant::where('status', 'active')->orderBy('name')->get();
        $totalCollected = $payments->where('status', 'paid')->sum('amount');

        return view('payments.index', compact('payments', 'tenants', 'totalCollected'));
    }

    public function create(Request $request)
    {
        $selectedTenantId = $request->input('tenant_id');
        $tenants = Tenant::with('boardingHouse')
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('payments.create', compact('tenants', 'selectedTenantId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenant_id'      => 'required|exists:tenants,id',
            'amount'         => 'required|numeric|min:0.01',
            'payment_date'   => 'required|date',
            'month_covered'  => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'status'         => 'required|string|in:paid,pending',
            'notes'          => 'nullable|string|max:1000',
        ]);

        Payment::create($validated);

        return redirect()->route('payments.index')->with('success', 'Payment record added successfully!');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment record deleted successfully.');
    }
}

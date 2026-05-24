<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Payment - BoardingPH</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Manrope', sans-serif;
            background: #f6f8fb;
            margin: 0;
            color: #1f2937;
        }

        /* ─── NAVBAR ─── */
        .navbar {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 60px;
            background: rgba(0, 0, 0, 0.88);
            backdrop-filter: blur(10px);
        }

        .nav-logo {
            color: white;
            font-size: 22px;
            font-weight: 800;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-logo svg {
            width: 28px;
            height: 28px;
            fill: #22c77a;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 24px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s ease;
            padding: 6px 12px;
            border-radius: 50px;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: white;
        }

        .nav-links a.active {
            background: white;
            color: #111;
            padding: 8px 18px;
            font-weight: 700;
        }

        .btn-list {
            background: #22c77a;
            color: white;
            padding: 10px 22px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: background 0.2s;
        }

        .btn-list:hover { background: #1da862; }

        @media (max-width: 768px) {
            .navbar { padding: 20px 20px; }
            .nav-links { display: none; }
        }

        /* ─── PAGE CONTAINER ─── */
        .page {
            max-width: 600px;
            margin: 0 auto;
            padding: 120px 24px 60px;
        }

        .form-card {
            background: white;
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.04);
        }

        .form-card h1 {
            margin: 0 0 8px;
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #111827;
        }

        .form-card p {
            margin: 0 0 32px;
            color: #6b7280;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 24px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-size: 0.88rem;
            font-weight: 700;
            color: #374151;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid #d1d5db;
            font-family: 'Manrope', sans-serif;
            font-size: 0.95rem;
            color: #111827;
            background: #f9fafb;
            transition: all 0.15s ease;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #22c77a;
            background: white;
            box-shadow: 0 0 0 4px rgba(34, 199, 122, 0.1);
        }

        .btn-submit {
            background: linear-gradient(135deg, #22c77a 0%, #16a34a 100%);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-family: 'Manrope', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            width: 100%;
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(34, 199, 122, 0.2);
            margin-top: 12px;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(34, 199, 122, 0.3);
        }

        .btn-cancel {
            background: transparent;
            color: #6b7280;
            border: 1px solid #d1d5db;
            padding: 12px 28px;
            border-radius: 12px;
            font-family: 'Manrope', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            width: 100%;
            text-align: center;
            text-decoration: none;
            box-sizing: border-box;
            display: inline-block;
            margin-top: 12px;
            transition: all 0.15s ease;
        }

        .btn-cancel:hover {
            background: #f3f4f6;
            color: #374151;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="/" class="nav-logo">
            <svg viewBox="0 0 24 24">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
            </svg>
        </a>

        <ul class="nav-links">
            <li><a href="/">Home</a></li>
            <li><a href="/listings">Listings</a></li>
            <li><a href="/rent">Rentals</a></li>
            <li><a href="/bookings">Bookings</a></li>
            <li><a href="/tenants">Tenants</a></li>
            <li><a href="/payments" class="active">Payments</a></li>
        </ul>
        <a href="{{ route('boarding-houses.create') }}" class="btn-list">
            +Add Boarding House
        </a>
    </nav>

    <div class="page">
        <div class="form-card">
            <h1>Record Rent Payment</h1>
            <p>Log a tenant's rent payment transaction in the ledger.</p>

            @if($errors->any())
                <div style="margin-bottom: 24px; padding: 14px 20px; background: #fee2e2; color: #991b1b; border-radius: 12px; font-size: 0.9rem; font-weight: 600; border: 1px solid #fecaca;">
                    <ul style="margin: 0; padding-left: 16px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('payments.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="tenant_id">Active Tenant</label>
                    <select name="tenant_id" id="tenant_id" required>
                        <option value="" disabled selected>Select a tenant</option>
                        @foreach($tenants as $t)
                            @php
                                $rate = $t->boardingHouse->price_per_month ?? 0;
                            @endphp
                            <option value="{{ $t->id }}" data-rate="{{ $rate }}" {{ (old('tenant_id', $selectedTenantId) == $t->id) ? 'selected' : '' }}>
                                {{ $t->name }} (Room: {{ $t->room_number ?? 'Bed' }} — Rate: ₱{{ number_format($rate, 0) }}/mo)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount">Payment Amount (₱)</label>
                    <input type="number" step="0.01" min="0.01" name="amount" id="amount" required placeholder="0.00" value="{{ old('amount') }}">
                </div>

                <div class="form-group">
                    <label for="payment_date">Payment Date</label>
                    <input type="date" name="payment_date" id="payment_date" required value="{{ old('payment_date', date('Y-m-d')) }}">
                </div>

                <div class="form-group">
                    <label for="month_covered">Month Covered</label>
                    <input type="text" name="month_covered" id="month_covered" required placeholder="e.g. May 2026" value="{{ old('month_covered', date('F Y')) }}">
                </div>

                <div class="form-group">
                    <label for="payment_method">Payment Method</label>
                    <select name="payment_method" id="payment_method" required>
                        <option value="Cash" {{ old('payment_method') === 'Cash' ? 'selected' : '' }}>Cash</option>
                        <option value="GCash" {{ old('payment_method', 'GCash') === 'GCash' ? 'selected' : '' }}>GCash</option>
                        <option value="Bank Transfer" {{ old('payment_method') === 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="Other" {{ old('payment_method') === 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" required>
                        <option value="paid" {{ old('status', 'paid') === 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending / Holding</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="notes">Transaction Notes</label>
                    <textarea name="notes" id="notes" placeholder="e.g. Reference numbers, dynamic details (optional)">{{ old('notes') }}</textarea>
                </div>

                <button type="submit" class="btn-submit">Record Payment</button>
                <a href="{{ route('payments.index') }}" class="btn-cancel">Cancel</a>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tenantSelect = document.getElementById('tenant_id');
            const amountInput = document.getElementById('amount');

            function updateAmount() {
                const selectedOption = tenantSelect.options[tenantSelect.selectedIndex];
                if (selectedOption && selectedOption.dataset.rate) {
                    amountInput.value = selectedOption.dataset.rate;
                }
            }

            tenantSelect.addEventListener('change', updateAmount);

            // Trigger on page load to pre-fill if a tenant is preselected
            if (tenantSelect.value) {
                updateAmount();
            }
        });
    </script>
</body>
</html>

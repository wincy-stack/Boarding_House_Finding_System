<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments Ledger - BoardingPH</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 120px 24px 60px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-header-text h1 {
            margin: 0 0 6px;
            font-size: 2.25rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: #111827;
        }

        .page-header-text p {
            margin: 0;
            color: #6b7280;
            font-size: 1.05rem;
        }

        .btn-add-payment {
            background: linear-gradient(135deg, #22c77a 0%, #16a34a 100%);
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.95rem;
            box-shadow: 0 4px 15px rgba(34, 199, 122, 0.2);
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-add-payment:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(34, 199, 122, 0.3);
        }

        /* ─── FILTER BOX ─── */
        .filter-panel {
            background: white;
            padding: 24px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.02);
            border: 1px solid rgba(0, 0, 0, 0.04);
            margin-bottom: 35px;
        }

        .filter-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            align-items: flex-end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .filter-group label {
            font-size: 0.8rem;
            font-weight: 700;
            color: #4b5563;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .filter-group select,
        .filter-group input {
            padding: 10px 14px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            font-family: 'Manrope', sans-serif;
            font-size: 0.9rem;
            background: #f9fafb;
            color: #111827;
        }

        .btn-filter-submit {
            background: #111827;
            color: white;
            border: none;
            padding: 11px 20px;
            border-radius: 10px;
            font-family: 'Manrope', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.15s ease;
        }

        .btn-filter-submit:hover {
            background: #374151;
        }

        .btn-filter-clear {
            background: #f3f4f6;
            color: #4b5563;
            border: none;
            padding: 11px 20px;
            border-radius: 10px;
            font-family: 'Manrope', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: all 0.15s ease;
        }

        .btn-filter-clear:hover {
            background: #e5e7eb;
            color: #1f2937;
        }

        /* ─── STATS CARDS ─── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.02);
            border: 1px solid rgba(0, 0, 0, 0.04);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon.green { background: rgba(34, 199, 122, 0.1); color: #22c77a; }
        .stat-icon.blue { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }

        .stat-info { display: flex; flex-direction: column; }
        .stat-label { font-size: 0.82rem; color: #6b7280; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; }
        .stat-value { font-size: 1.8rem; font-weight: 800; color: #111827; margin: 4px 0 0; }

        /* ─── SECTION STYLING ─── */
        .section-title {
            font-size: 1.35rem;
            font-weight: 800;
            margin: 0 0 20px;
            color: #111827;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title span {
            background: #e5e7eb;
            color: #4b5563;
            font-size: 0.8rem;
            font-weight: 700;
            padding: 2px 10px;
            border-radius: 999px;
        }

        .table-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.02);
            border: 1px solid rgba(0, 0, 0, 0.04);
            overflow: hidden;
            margin-bottom: 48px;
        }

        .rentals-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .rentals-table th {
            background: #f9fafb;
            padding: 16px 24px;
            font-weight: 700;
            font-size: 0.85rem;
            color: #4b5563;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #f3f4f6;
        }

        .rentals-table td {
            padding: 20px 24px;
            font-size: 0.95rem;
            color: #111827;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }

        .rentals-table tr:last-child td {
            border-bottom: none;
        }

        .tenant-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .tenant-name { font-weight: 800; color: #111827; }
        .tenant-meta { font-size: 0.85rem; color: #6b7280; font-weight: 500; }

        .badge {
            display: inline-flex;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .badge.paid { background: #ecfdf5; color: #047857; }
        .badge.pending { background: #fffbeb; color: #b45309; }

        .btn-delete {
            background: #fee2e2;
            color: #ef4444;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            font-family: 'Manrope', sans-serif;
            font-weight: 700;
            font-size: 0.82rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-delete:hover {
            background: #fca5a5;
            color: #b91c1c;
        }

        /* ─── EMPTY STATE ─── */
        .empty-state {
            padding: 60px 24px;
            text-align: center;
            color: #6b7280;
        }

        .empty-state svg {
            margin-bottom: 16px;
            stroke: #d1d5db;
        }

        .empty-state h3 {
            margin: 0 0 6px;
            color: #4b5563;
            font-size: 1.1rem;
            font-weight: 800;
        }

        .empty-state p {
            margin: 0;
            font-size: 0.9rem;
            color: #9ca3af;
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
        <div class="page-header">
            <div class="page-header-text">
                <h1>Rent Payments Ledger</h1>
                <p>Record tenant rents, view income summaries, and filter payment histories.</p>
            </div>
            <a href="{{ route('payments.create') }}" class="btn-add-payment">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                Record Rent Payment
            </a>
        </div>

        @if(session('success'))
            <div style="margin-bottom: 24px; padding: 14px 20px; background: #d1fae5; color: #065f46; border-radius: 12px; font-size: 0.9rem; font-weight: 600; border: 1px solid #a7f3d0; display: flex; align-items: center; gap: 10px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Stats Grid --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon green">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Total Income Collected</span>
                    <h2 class="stat-value">₱{{ number_format($totalCollected, 2) }}</h2>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon blue">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Total Transactions</span>
                    <h2 class="stat-value">{{ $payments->count() }}</h2>
                </div>
            </div>
        </div>

        {{-- Filter Panel --}}
        <div class="filter-panel">
            <form action="{{ route('payments.index') }}" method="GET" class="filter-form">
                <div class="filter-group">
                    <label for="tenant_id">Filter by Tenant</label>
                    <select name="tenant_id" id="tenant_id">
                        <option value="">All Active Tenants</option>
                        @foreach($tenants as $t)
                            <option value="{{ $t->id }}" {{ request('tenant_id') == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label for="month">Filter Month</label>
                    <input type="text" name="month" id="month" placeholder="e.g. May 2026" value="{{ request('month') }}">
                </div>

                <div class="filter-group">
                    <label for="method">Method</label>
                    <select name="method" id="method">
                        <option value="">All Methods</option>
                        <option value="Cash" {{ request('method') === 'Cash' ? 'selected' : '' }}>Cash</option>
                        <option value="GCash" {{ request('method') === 'GCash' ? 'selected' : '' }}>GCash</option>
                        <option value="Bank Transfer" {{ request('method') === 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="Other" {{ request('method') === 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="btn-action-group" style="gap: 12px; margin-top: 10px;">
                    <button type="submit" class="btn-filter-submit">Apply Filters</button>
                    <a href="{{ route('payments.index') }}" class="btn-filter-clear">Reset</a>
                </div>
            </form>
        </div>

        {{-- Payments Ledger Table --}}
        <h2 class="section-title">Payment Ledgers <span>{{ $payments->count() }}</span></h2>
        <div class="table-container">
            @if($payments->count() > 0)
                <table class="rentals-table">
                    <thead>
                        <tr>
                            <th>Tenant Name</th>
                            <th>Boarding House</th>
                            <th>Amount Paid</th>
                            <th>Month Covered</th>
                            <th>Payment Date</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>
                                    <div class="tenant-info">
                                        <span class="tenant-name">{{ $payment->tenant->name ?? 'Deleted Tenant' }}</span>
                                        @if($payment->tenant && $payment->tenant->contact)
                                            <span class="tenant-meta">{{ $payment->tenant->contact }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($payment->tenant && $payment->tenant->boardingHouse)
                                        <div class="house-info">
                                            <span class="house-name">{{ $payment->tenant->boardingHouse->name }}</span>
                                            <span class="house-loc">{{ $payment->tenant->boardingHouse->location }}</span>
                                        </div>
                                    @else
                                        <span style="color: #9ca3af; font-style: italic;">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <strong style="color: #16a34a; font-size: 1.05rem;">₱{{ number_format($payment->amount, 2) }}</strong>
                                </td>
                                <td>
                                    <strong style="color: #374151;">{{ $payment->month_covered }}</strong>
                                </td>
                                <td style="color: #4b5563; font-weight: 500;">
                                    {{ $payment->payment_date ? $payment->payment_date->format('M d, Y') : '—' }}
                                </td>
                                <td style="color: #4b5563; font-weight: 600;">
                                    {{ $payment->payment_method }}
                                </td>
                                <td>
                                    <span class="badge {{ $payment->status }}">{{ ucfirst($payment->status) }}</span>
                                </td>
                                <td style="max-width: 180px; font-size: 0.85rem; color: #6b7280; line-height: 1.4;">
                                    {{ $payment->notes ?? '—' }}
                                </td>
                                <td>
                                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('Void this payment entry? This is irreversible.');" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Void</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"/><path d="M12 6V12L16 14"/></svg>
                    <h3>No payment transactions found</h3>
                    <p>Change your filter options or add new payments to start viewing transaction logs.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>

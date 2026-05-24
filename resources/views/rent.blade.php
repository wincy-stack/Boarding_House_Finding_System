<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent - BoardingPH</title>
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
            background: rgba(0, 0, 0, 0.8);
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
            gap: 36px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: white;
        }

        .nav-links a.active {
            background: white;
            color: #111;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
        }

        .btn-list {
            background: #22c77a;
            color: white;
            padding: 10px 22px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: background 0.2s;
        }

        .btn-list:hover { background: #1da862; }

        @media (max-width: 768px) {
            .navbar { padding: 20px 20px; }
            .nav-links { display: none; }
        }

        /* ─── PAGE CONTAINER ─── */
        .page {
            max-width: 1100px;
            margin: 0 auto;
            padding: 120px 24px 60px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            margin: 0 0 6px;
            font-size: 2.25rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: #111827;
        }

        .page-header p {
            margin: 0;
            color: #6b7280;
            font-size: 1.05rem;
        }

        /* ─── STATS CARDS ─── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
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

        .stat-icon.blue { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
        .stat-icon.green { background: rgba(34, 199, 122, 0.1); color: #22c77a; }

        .stat-info { display: flex; flex-direction: column; }
        .stat-label { font-size: 0.85rem; color: #6b7280; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; }
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
            padding: 18px 24px;
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
        .tenant-phone { font-size: 0.85rem; color: #6b7280; font-weight: 500; }
        .tenant-email { font-size: 0.82rem; color: #6b7280; font-weight: 500; }

        .house-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .house-name { font-weight: 800; color: #111827; }
        .house-loc { font-size: 0.85rem; color: #6b7280; font-weight: 500; }

        .badge {
            display: inline-flex;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .badge.active { background: #ecfdf5; color: #047857; }
        .badge.ended { background: #f3f4f6; color: #4b5563; }

        .btn-end-rental {
            background: #fee2e2;
            color: #ef4444;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-family: 'Manrope', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-end-rental:hover {
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
            <li><a href="/rent" class="active">Rent</a></li>
        </ul>
        <a href="{{ route('boarding-houses.create') }}" class="btn-list">
            +Add Boarding House
        </a>
    </nav>

    <div class="page">
        <div class="page-header">
            <h1>Rental Records</h1>
            <p>Monitor your active renters and past rental history.</p>
        </div>

        @if(session('success'))
            <div style="margin-bottom: 24px; padding: 14px 20px; background: #d1fae5; color: #065f46; border-radius: 12px; font-size: 0.9rem; font-weight: 600; border: 1px solid #a7f3d0; display: flex; align-items: center; gap: 10px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="margin-bottom: 24px; padding: 14px 20px; background: #fee2e2; color: #991b1b; border-radius: 12px; font-size: 0.9rem; font-weight: 600; border: 1px solid #fecaca; display: flex; align-items: center; gap: 10px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Stats Grid --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Active Tenants</span>
                    <h2 class="stat-value">{{ $totalActive }}</h2>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Monthly Value</span>
                    <h2 class="stat-value">₱{{ number_format($monthlyRevenue, 0) }}</h2>
                </div>
            </div>
        </div>

        {{-- Active Rentals Section --}}
        <h2 class="section-title">Active Rentals <span>{{ $activeRentals->count() }}</span></h2>
        <div class="table-container">
            @if($activeRentals->count() > 0)
                <table class="rentals-table">
                    <thead>
                        <tr>
                            <th>Tenant Details</th>
                            <th>Boarding House</th>
                            <th>Monthly Rent</th>
                            <th>Date Rented</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeRentals as $rental)
                            <tr>
                                <td>
                                    <div class="tenant-info">
                                        <span class="tenant-name">{{ $rental->tenant_name }}</span>
                                        @if($rental->tenant_email)
                                            <span class="tenant-email">{{ $rental->tenant_email }}</span>
                                        @endif
                                        @if($rental->tenant_contact)
                                            <span class="tenant-phone">{{ $rental->tenant_contact }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="house-info">
                                        <span class="house-name">{{ $rental->boardingHouse->name ?? 'Deleted House' }}</span>
                                        <span class="house-loc">{{ $rental->boardingHouse->location ?? '' }}, {{ $rental->boardingHouse->city->name ?? '' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <strong style="color: #111827; font-size: 1.05rem;">₱{{ number_format($rental->price_per_month, 0) }}/mo</strong>
                                </td>
                                <td style="color: #4b5563; font-weight: 500;">
                                    {{ $rental->rental_date ? $rental->rental_date->format('M d, Y h:i A') : '—' }}
                                </td>
                                <td>
                                    <form action="{{ route('rentals.end', $rental->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to end this rental and release the bed?');">
                                        @csrf
                                        <button type="submit" class="btn-end-rental">End Rental</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <h3>No active rentals</h3>
                    <p>Rentals will appear here once a room listing is rented.</p>
                </div>
            @endif
        </div>

        {{-- Past Rentals Section --}}
        <h2 class="section-title">Past History <span>{{ $pastRentals->count() }}</span></h2>
        <div class="table-container">
            @if($pastRentals->count() > 0)
                <table class="rentals-table">
                    <thead>
                        <tr>
                            <th>Tenant Details</th>
                            <th>Boarding House</th>
                            <th>Rate</th>
                            <th>Date Rented</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pastRentals as $rental)
                            <tr>
                                <td>
                                    <div class="tenant-info">
                                        <span class="tenant-name">{{ $rental->tenant_name }}</span>
                                        @if($rental->tenant_email)
                                            <span class="tenant-email">{{ $rental->tenant_email }}</span>
                                        @endif
                                        @if($rental->tenant_contact)
                                            <span class="tenant-phone">{{ $rental->tenant_contact }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="house-info">
                                        <span class="house-name">{{ $rental->boardingHouse->name ?? 'Deleted House' }}</span>
                                        <span class="house-loc">{{ $rental->boardingHouse->location ?? '' }}, {{ $rental->boardingHouse->city->name ?? '' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span style="color: #6b7280; font-weight: 500;">₱{{ number_format($rental->price_per_month, 0) }}/mo</span>
                                </td>
                                <td style="color: #6b7280; font-weight: 500;">
                                    {{ $rental->rental_date ? $rental->rental_date->format('M d, Y') : '—' }}
                                </td>
                                <td>
                                    <span class="badge ended">Ended</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <h3>No past records</h3>
                    <p>Ended rental history will be archived here.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>

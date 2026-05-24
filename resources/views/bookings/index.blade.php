<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings & Inquiries - BoardingPH</title>
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

        .stat-icon.orange { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
        .stat-icon.green { background: rgba(34, 199, 122, 0.1); color: #22c77a; }
        .stat-icon.red { background: rgba(239, 68, 68, 0.1); color: #ef4444; }

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
        .badge.pending { background: #fef3c7; color: #d97706; }
        .badge.approved { background: #d1fae5; color: #065f46; }
        .badge.rejected { background: #fee2e2; color: #b91c1c; }

        .btn-action-group {
            display: flex;
            gap: 8px;
        }

        .btn-approve {
            background: #22c77a;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-family: 'Manrope', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-approve:hover {
            background: #1da862;
        }

        .btn-reject {
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

        .btn-reject:hover {
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
            <li><a href="/bookings" class="active">Bookings</a></li>
            <li><a href="/tenants">Tenants</a></li>
            <li><a href="/payments">Payments</a></li>
        </ul>
        <a href="{{ route('boarding-houses.create') }}" class="btn-list">
            +Add Boarding House
        </a>
    </nav>

    <div class="page">
        <div class="page-header">
            <h1>Bookings & Inquiries</h1>
            <p>Manage pending inquiries, room requests, and view previous reservation history.</p>
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
                <div class="stat-icon orange">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Pending Inquiries</span>
                    <h2 class="stat-value">{{ $pendingBookings->count() }}</h2>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Approved Overall</span>
                    <h2 class="stat-value">{{ $allBookings->where('status', 'approved')->count() }}</h2>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon red">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Rejected Overall</span>
                    <h2 class="stat-value">{{ $allBookings->where('status', 'rejected')->count() }}</h2>
                </div>
            </div>
        </div>

        {{-- Pending Inquiries Section --}}
        <h2 class="section-title">Pending Room Inquiries <span>{{ $pendingBookings->count() }}</span></h2>
        <div class="table-container">
            @if($pendingBookings->count() > 0)
                <table class="rentals-table">
                    <thead>
                        <tr>
                            <th>Guest Details</th>
                            <th>Boarding House</th>
                            <th>Requested Room</th>
                            <th>Inquiry Notes</th>
                            <th>Date Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingBookings as $booking)
                            <tr>
                                <td>
                                    <div class="tenant-info">
                                        <span class="tenant-name">{{ $booking->tenant_name }}</span>
                                        @if($booking->tenant_email)
                                            <span class="tenant-meta">{{ $booking->tenant_email }}</span>
                                        @endif
                                        @if($booking->tenant_contact)
                                            <span class="tenant-meta">{{ $booking->tenant_contact }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="house-info">
                                        <span class="house-name">{{ $booking->boardingHouse->name ?? 'Deleted House' }}</span>
                                        <span class="house-loc">{{ $booking->boardingHouse->location ?? '' }}, {{ $booking->boardingHouse->city->name ?? '' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <strong style="color: #4b5563;">{{ $booking->room_number ?? 'Any Available' }}</strong>
                                </td>
                                <td style="max-width: 250px; font-size: 0.88rem; color: #4b5563; line-height: 1.4;">
                                    {{ $booking->notes ?? 'No notes provided.' }}
                                </td>
                                <td style="color: #4b5563; font-weight: 500;">
                                    {{ $booking->created_at->format('M d, Y h:i A') }}
                                </td>
                                <td>
                                    <div class="btn-action-group">
                                        <form action="{{ route('bookings.approve', $booking->id) }}" method="POST" onsubmit="return confirm('Approve this booking? This will create a Tenant and lock a bed.');">
                                            @csrf
                                            <button type="submit" class="btn-approve">Approve</button>
                                        </form>
                                        <form action="{{ route('bookings.reject', $booking->id) }}" method="POST" onsubmit="return confirm('Reject this booking request?');">
                                            @csrf
                                            <button type="submit" class="btn-reject">Reject</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    <h3>No pending inquiries</h3>
                    <p>New inquiries from guests booking rooms will appear here.</p>
                </div>
            @endif
        </div>

        {{-- Processed Bookings History Section --}}
        <h2 class="section-title">Inquiry History <span>{{ $allBookings->count() }}</span></h2>
        <div class="table-container">
            @if($allBookings->count() > 0)
                <table class="rentals-table">
                    <thead>
                        <tr>
                            <th>Guest Details</th>
                            <th>Boarding House</th>
                            <th>Room / Bed</th>
                            <th>Inquiry Notes</th>
                            <th>Processed Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allBookings as $booking)
                            <tr>
                                <td>
                                    <div class="tenant-info">
                                        <span class="tenant-name">{{ $booking->tenant_name }}</span>
                                        @if($booking->tenant_email)
                                            <span class="tenant-meta">{{ $booking->tenant_email }}</span>
                                        @endif
                                        @if($booking->tenant_contact)
                                            <span class="tenant-meta">{{ $booking->tenant_contact }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="house-info">
                                        <span class="house-name">{{ $booking->boardingHouse->name ?? 'Deleted House' }}</span>
                                        <span class="house-loc">{{ $booking->boardingHouse->location ?? '' }}, {{ $booking->boardingHouse->city->name ?? '' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <strong style="color: #6b7280;">{{ $booking->room_number ?? 'Any' }}</strong>
                                </td>
                                <td style="max-width: 250px; font-size: 0.88rem; color: #6b7280; line-height: 1.4;">
                                    {{ $booking->notes ?? '—' }}
                                </td>
                                <td style="color: #6b7280; font-weight: 500;">
                                    {{ $booking->updated_at->format('M d, Y') }}
                                </td>
                                <td>
                                    <span class="badge {{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <h3>No processed inquiries</h3>
                    <p>Your processed history will show up here.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>

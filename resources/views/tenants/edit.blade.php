<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tenant - BoardingPH</title>
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

        .form-group input {
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid #d1d5db;
            font-family: 'Manrope', sans-serif;
            font-size: 0.95rem;
            color: #111827;
            background: #f9fafb;
            transition: all 0.15s ease;
        }

        .form-group input:focus {
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
            <li><a href="/tenants" class="active">Tenants</a></li>
            <li><a href="/payments">Payments</a></li>
        </ul>
        <a href="{{ route('boarding-houses.create') }}" class="btn-list">
            +Add Boarding House
        </a>
    </nav>

    <div class="page">
        <div class="form-card">
            <h1>Edit Tenant Profile</h1>
            <p>Modify contact information or re-allocate room assignments for <strong>{{ $tenant->name }}</strong>.</p>

            @if($errors->any())
                <div style="margin-bottom: 24px; padding: 14px 20px; background: #fee2e2; color: #991b1b; border-radius: 12px; font-size: 0.9rem; font-weight: 600; border: 1px solid #fecaca;">
                    <ul style="margin: 0; padding-left: 16px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tenants.update', $tenant->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group" style="background: #f9fafb; padding: 14px; border-radius: 12px; border: 1px solid #f3f4f6; margin-bottom: 24px;">
                    <span style="font-size: 0.75rem; text-transform: uppercase; color: #9ca3af; font-weight: 700;">Current Boarding House</span>
                    <strong style="display: block; font-size: 1rem; color: #374151; margin-top: 4px;">{{ $tenant->boardingHouse->name ?? 'Deleted House' }}</strong>
                </div>

                <div class="form-group">
                    <label for="name">Tenant Full Name</label>
                    <input type="text" name="name" id="name" required placeholder="Enter full name" value="{{ old('name', $tenant->name) }}">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="e.g. email@domain.com" value="{{ old('email', $tenant->email) }}">
                </div>

                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <input type="text" name="contact" id="contact" placeholder="e.g. 09123456789" value="{{ old('contact', $tenant->contact) }}">
                </div>

                <div class="form-group">
                    <label for="room_number">Assigned Room / Bed Number</label>
                    <input type="text" name="room_number" id="room_number" placeholder="e.g. Room A, Bed 1 (optional)" value="{{ old('room_number', $tenant->room_number) }}">
                </div>

                <button type="submit" class="btn-submit">Save Tenant Details</button>
                <a href="{{ route('tenants.index') }}" class="btn-cancel">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>

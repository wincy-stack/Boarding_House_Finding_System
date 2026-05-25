<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BoardingPH - Find Your Perfect Boarding House</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Manrope', sans-serif;
            overflow-x: hidden;
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
        }

        .nav-links a {
            color: rgba(255,255,255,0.85);
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

        .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-browse {
            color: white;
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            opacity: 0.85;
        }

        .nav-browse:hover { opacity: 1; }

        .btn-list {
            background: #22c77a;
            color: white;
            padding: 10px 22px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: background 0.2s, transform 0.1s;
        }

        .btn-list:hover {
            background: #1aad69;
            transform: translateY(-1px);
        }

        /* ─── HERO ─── */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 120px 20px 80px;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1600&q=80');
            background-size: cover;
            background-position: center;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(0,0,0,0.45) 0%,
                rgba(0,0,0,0.5) 50%,
                rgba(0,0,0,0.65) 100%
            );
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 820px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.25);
            backdrop-filter: blur(8px);
            color: white;
            font-size: 13px;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: 50px;
            margin-bottom: 28px;
        }

        .hero-badge svg {
            width: 14px;
            height: 14px;
            fill: #22c77a;
        }

        .hero-title {
            font-size: clamp(48px, 7vw, 88px);
            font-weight: 800;
            line-height: 1.05;
            color: white;
            margin-bottom: 20px;
            letter-spacing: -1px;
        }

        .hero-title .green {
            color: #22c77a;
            display: block;
        }

        .hero-subtitle {
            font-size: 18px;
            color: rgba(255,255,255,0.82);
            line-height: 1.65;
            max-width: 540px;
            margin: 0 auto 44px;
            font-weight: 400;
        }

        /* ─── SEARCH BAR ─── */
        .search-bar {
            background: white;
            border-radius: 16px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 0;
            max-width: 780px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
        }

        .search-field {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 0 20px;
            border-right: 1px solid #e8e8e8;
        }

        .search-field:first-child { padding-left: 4px; }

        .search-field label {
            font-size: 11px;
            color: #888;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .search-field select {
            border: none;
            outline: none;
            font-size: 15px;
            font-weight: 600;
            color: #111;
            font-family: 'Manrope', sans-serif;
            cursor: pointer;
            background: transparent;
            appearance: none;
            -webkit-appearance: none;
            padding-right: 20px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23999' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0 center;
        }

        .search-field-icon {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-field-icon svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        .btn-search {
            background: #22c77a;
            color: white;
            border: none;
            padding: 16px 32px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            margin-left: 12px;
            transition: background 0.2s, transform 0.1s;
            font-family: 'Manrope', sans-serif;
        }

        .btn-search:hover {
            background: #1aad69;
            transform: translateY(-1px);
        }

        .btn-search svg {
            width: 18px;
            height: 18px;
        }

        /* ─── STATS ─── */
        .hero-stats {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 60px;
            margin-top: 52px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 800;
            color: white;
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 13px;
            color: rgba(255,255,255,0.65);
            font-weight: 500;
        }

        .stat-divider {
            width: 1px;
            height: 40px;
            background: rgba(255,255,255,0.2);
        }

        /* ─── SCROLL HINT ─── */
        .scroll-hint {
            position: relative;
            z-index: 2;
            margin-top: 40px;
            color: rgba(255,255,255,0.5);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .scroll-hint svg {
            width: 20px;
            height: 20px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(6px); }
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 768px) {
            .navbar { padding: 16px 20px; }
            .nav-links { display: none; }
            .search-bar { flex-direction: column; padding: 12px; gap: 8px; }
            .search-field { border-right: none; border-bottom: 1px solid #e8e8e8; padding: 8px 4px; width: 100%; }
            .btn-search { width: 100%; justify-content: center; margin-left: 0; margin-top: 4px; }
            .hero-stats { gap: 24px; flex-wrap: wrap; justify-content: center; }
            .stat-divider { display: none; }
        }
    </style>
</head>

<body>

    {{-- ─── NAVBAR ─── --}}
    <nav class="navbar">
        <a href="/" class="nav-logo">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
            </svg>
            <span style="font-size: 20px; font-weight: 800; color: white; margin-left: -4px;">BoardingPH</span>
        </a>

        <ul class="nav-links">
            <li><a href="/" class="active">Home</a></li>
            <li><a href="/listings">Listings</a></li>
            @auth
                @if(auth()->user()->isAdmin())
                    <li><a href="/rent">Rentals</a></li>
                    <li><a href="/bookings">Bookings</a></li>
                    <li><a href="/tenants">Tenants</a></li>
                    <li><a href="/payments">Payments</a></li>
                @endif
            @endauth
        </ul>

        <div class="nav-right">
            @auth
                <span style="color: rgba(255,255,255,0.9); font-size: 14px; font-weight: 600;">Hi, {{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0; display: inline;">
                    @csrf
                    <button type="submit" class="btn-list" style="border: none; cursor: pointer; font-family: 'Manrope', sans-serif;">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-browse">Log In</a>
                <a href="{{ route('register') }}" class="btn-list">Register</a>
            @endauth
        </div>
    </nav>

    {{-- ─── HERO SECTION ─── --}}
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>

        <div class="hero-content">

            {{-- Badge --}}
            <div class="hero-badge">
                <svg viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                Philippines' Most Trusted Boarding House Platform
            </div>

            {{-- Headline --}}
            <h1 class="hero-title">
                Find Your Perfect
                <span class="green">Boarding House</span>
            </h1>

            {{-- Subtext --}}
            <p class="hero-subtitle">
                Search thousands of verified listings across the Philippines. Safe,
                affordable, and just right for you.
            </p>

            {{-- Search Bar --}}
            <form action="/listings" method="GET" class="search-bar">

                {{-- Area --}}
                <div class="search-field">
                    <label>Area</label>
                    <div class="search-field-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#22c77a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        <select name="city_id">
                            <option value="">Any Area</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Room Type --}}
                <div class="search-field">
                    <label>Room Type</label>
                    <div class="search-field-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#22c77a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                        <select name="room_type">
                            <option value="">Any Type</option>
                            <option value="single">Single Room</option>
                            <option value="shared">Shared Room</option>
                        </select>
                    </div>
                </div>

                {{-- Budget --}}
                <div class="search-field" style="border-right: none;">
                    <label>Max Budget</label>
                    <div class="search-field-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#22c77a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="1" x2="12" y2="23"/>
                            <path d="M17 5H9.5a3.5 3.5 0 100 7h5a3.5 3.5 0 110 7H6"/>
                        </svg>
                        <select name="budget">
                            <option value="">Any Price</option>
                            <option value="2000">Under ₱2,000</option>
                            <option value="4000">₱2,000 – ₱4,000</option>
                            <option value="6000">₱4,000 – ₱6,000</option>
                            <option value="10000">₱6,000 – ₱10,000</option>
                            <option value="99999">₱10,000+</option>
                        </select>
                    </div>
                </div>

                {{-- Search Button --}}
                <button type="submit" class="btn-search">
                    <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    Search
                </button>
            </form>
        </div>

        {{-- Stats --}}
        <!-- <div class="hero-stats">
            <div class="stat-item">
                <div class="stat-number">0</div>
                <div class="stat-label">Active Listings</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <div class="stat-number">0</div>
                <div class="stat-label">Cities Covered</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <div class="stat-number">0</div>
                <div class="stat-label">Happy Tenants</div>
            </div>
        </div> -->

    </section>

    {{-- Add more sections below (Featured Listings, How it Works, etc.) --}}

</body>
</html>
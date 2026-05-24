<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listings - BoardingPH</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
   <style>
    body {
        font-family: 'Manrope', sans-serif;
        background: #f5f5f5;
        margin: 0;
        color: #111827;
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
        background: rgba(0,0,0,0.8);
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
        font-size: 15px;
        font-weight: 500;
        transition: background 0.2s;
    }

    .btn-list:hover { background: #1da862; }

    /* Responsive */
    @media (max-width: 768px) {
        .navbar {
            padding: 20px 20px;
        }
        .nav-links { display: none; }
        .nav-right { display: none; }
    }

    .page {
        max-width: 1000px;
        margin: 0 auto;
        padding: 98px 18px 0;
    }

    .page h1 {
        margin-bottom: 6px;
        font-size: 2rem;
        letter-spacing: -0.03em;
    }

    .page p {
        margin: 0;
        color: #6b7280;
    }

    .main-layout {
        display: grid;
        grid-template-columns: minmax(240px, 300px) 1fr;
        gap: 24px;
        padding: 0 18px 18px;
        max-width: 1100px;
        margin: 0 auto;
    }

    .filters-sidebar {
        display: grid;
        gap: 24px;
    }

    .filter-box {
        width: 70%;
        max-height: 70vh;
        background: white;
        padding: 20px;
        border-radius: 18px;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }

    .filter-box + .filter-box {
        margin-top: 0;
    }

    .filter-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .filter-header a {
        color: #10b981;
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 600;
    }

    h4 {
        margin: 0 0 12px;
        font-size: 0.85rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #6b7280;
    }

    .filter-list {
        list-style: none;
        padding: 0;
        max-height: 46vh;
        overflow-y: auto;
        margin: 0;
        display: grid;
        gap: 10px;
    }

    .filter-list li {
        padding: 0;
        border-radius: 12px;
    }

    .filter-list li button {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #f8fafc;
        color: #111827;
        cursor: pointer;
        font-size: 0.95rem;
        text-align: left;
        transition: all 0.2s ease;
    }

    .filter-list li button:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
    }

    .filter-list li button.active {
        background: #d1fae5;
        color: #065f46;
        font-weight: 700;
    }

    .filter-section {
        margin-top: 20px;
    }

    .price-range {
        background: #f8fafc;
        padding: 16px;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        display: grid;
        gap: 12px;
    }

    .price-values {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 0;
        font-size: 0.9rem;
        color: #374151;
        font-weight: 600;
    }

    .price-values span {
        white-space: nowrap;
    }

    .price-range input[type="range"] {
        width: 100%;
        accent-color: #10b981;
    }

    .availability-toggle {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .pill {
        border: 1px solid #e5e7eb;
        background: #f8fafc;
        color: #374151;
        padding: 10px 14px;
        border-radius: 999px;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .pill.active {
        background: #10b981;
        color: white;
        border-color: transparent;
    }

    .pill:hover {
        background: #ecfdf5;
    }

    .cards-grid {
        display: grid;
        gap: 22px;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        align-items: start;
    }

    .room-card {
        position: relative;
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    /* ─── CARD ACTION BUTTONS (Edit / Delete) ─── */
    .card-actions {
        position: absolute;
        top: 8px;
        right: 8px;
        display: flex;
        gap: 6px;
        z-index: 10;
        opacity: 0;
        transition: opacity 0.2s ease;
    }

    .room-card:hover .card-actions {
        opacity: 1;
    }

    .card-action-btn {
        width: 32px;
        height: 32px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.15s ease;
        backdrop-filter: blur(6px);
        text-decoration: none;
    }

    .card-action-btn svg {
        width: 15px;
        height: 15px;
    }

    .card-action-btn.btn-edit {
        background: rgba(255, 255, 255, 0.9);
        color: #374151;
    }

    .card-action-btn.btn-edit:hover {
        background: #dbeafe;
        color: #2563eb;
    }

    .card-action-btn.btn-delete {
        background: rgba(255, 255, 255, 0.9);
        color: #6b7280;
    }

    .card-action-btn.btn-delete:hover {
        background: #fee2e2;
        color: #dc2626;
    }

    .room-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 34px rgba(15, 23, 42, 0.12);
    }

    .room-card img {
        width: 100%;
        height: 140px;
        object-fit: cover;
    }

    .room-card-body {
        padding: 14px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        flex: 1;
    }

    .room-card-tags {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .tag {
        display: inline-flex;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
        background: #ecfdf5;
        color: #047857;
    }

    .tag.booked {
        background: #fee2e2;
        color: #991b1b;
    }

    .room-card-title {
        margin: 0;
        font-size: 1rem;
        line-height: 1.3;
        color: #111827;
    }

    .room-card-subtitle {
        color: #6b7280;
        font-size: 0.85rem;
    }

    .room-card-meta {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 8px;
        color: #6b7280;
        font-size: 0.82rem;
    }

    .meta-item {
        display: flex;
        justify-content: space-between;
        gap: 8px;
    }

    .room-card-footer {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .room-price {
        font-size: 1.25rem;
        font-weight: 800;
        color: #111827;
        white-space: nowrap;
    }

    .room-rating {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.95rem;
        color: #f59e0b;
        font-weight: 700;
    }

    .room-rating span {
        color: #6b7280;
        font-weight: 600;
    }

    /* --- RENT ROOM BUTTON --- */
    .btn-rent {
        width: 100%;
        background: linear-gradient(135deg, #22c77a 0%, #16a34a 100%);
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 10px;
        font-family: 'Manrope', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 10px rgba(34, 199, 122, 0.2);
        text-align: center;
    }

    .btn-rent:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(34, 199, 122, 0.3);
    }

    .btn-rent:active {
        transform: translateY(0);
    }

    .btn-rent.btn-disabled {
        background: #e5e7eb;
        color: #9ca3af;
        cursor: not-allowed;
        box-shadow: none;
        transform: none;
    }

    /* --- MODAL STYLES --- */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.2s ease-out;
    }

    .modal-overlay.active {
        opacity: 1;
    }

    .modal-content {
        background: white;
        padding: 28px;
        border-radius: 20px;
        width: 90%;
        max-width: 440px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        transform: scale(0.95);
        transition: transform 0.2s ease-out;
    }

    .modal-overlay.active .modal-content {
        transform: scale(1);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        border-bottom: 1px solid #f3f4f6;
        padding-bottom: 14px;
    }

    .modal-header h3 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 800;
        color: #111827;
        letter-spacing: -0.02em;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 1.5rem;
        font-weight: 700;
        color: #9ca3af;
        cursor: pointer;
        transition: color 0.15s ease;
    }

    .modal-close:hover {
        color: #1f2937;
    }

    .modal-form-group {
        margin-bottom: 18px;
    }

    .modal-form-group label {
        display: block;
        font-weight: 700;
        margin-bottom: 6px;
        font-size: 0.88rem;
        color: #374151;
    }

    .modal-form-group input {
        width: 100%;
        padding: 11px 14px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        font-family: 'Manrope', sans-serif;
        font-size: 0.95rem;
        box-sizing: border-box;
        transition: all 0.15s ease;
        outline: none;
    }

    .modal-form-group input:focus {
        border-color: #22c77a;
        box-shadow: 0 0 0 3px rgba(34, 199, 122, 0.15);
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 24px;
    }

    .btn-modal-cancel {
        background: #f3f4f6;
        color: #4b5563;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-family: 'Manrope', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        transition: background 0.15s ease;
    }

    .btn-modal-cancel:hover {
        background: #e5e7eb;
    }

    .btn-modal-submit {
        background: #22c77a;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-family: 'Manrope', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        transition: background 0.15s ease;
    }

    .btn-modal-submit:hover {
        background: #1da862;
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
            <li><a href="/listings" class="active">Listings</a></li>
            <li><a href="/rent">Rent</a></li>
        </ul>
        <a href="{{ route('boarding-houses.create') }}" class="btn-list">
    +Add Boarding House
</a>
    </nav>

    <div class="page">
        <h1>Browse Listing</h1>
        <p>{{ $boardingHouses->count() }} Boarding House{{ $boardingHouses->count() !== 1 ? 's' : '' }} Found</p>

        @if(session('success'))
            <div style="margin-top: 16px; padding: 14px 20px; background: #d1fae5; color: #065f46; border-radius: 12px; font-size: 0.9rem; font-weight: 600; border: 1px solid #a7f3d0; display: flex; align-items: center; gap: 10px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="main-layout">
        <div class="filters-sidebar">
            <div class="filter-box">
                <div class="filter-header">
                    <span>Filter</span>
                    <a href="/listings">Clear All</a>
                </div>

                <h4>City</h4>
                <ul class="filter-list city-list">
                    <li><button class="{{ empty($filters['city_id']) ? 'active' : '' }}" type="button" data-city="All">All</button></li>
                    @forelse($cities as $city)
                        <li><button class="{{ (!empty($filters['city_id']) && $filters['city_id'] == $city->id) ? 'active' : '' }}" type="button" data-city="{{ $city->name }}">{{ $city->name }}</button></li>
                    @empty
                        <li>No cities found.</li>
                    @endforelse
                </ul>
            </div>

            <div class="filter-box">
                <div class="filter-header">
                    <span>Filter</span>
                    <a href="/listings">Clear All</a>
                </div>
                <h4>Room</h4>
                <ul class="filter-list room-list">
                    <li><button class="{{ empty($filters['room_type']) ? 'active' : '' }}" type="button" data-room="All">All</button></li>
                    <li><button class="{{ (!empty($filters['room_type']) && $filters['room_type'] === 'single') ? 'active' : '' }}" type="button" data-room="single">Single Room</button></li>
                    <li><button class="{{ (!empty($filters['room_type']) && $filters['room_type'] === 'shared') ? 'active' : '' }}" type="button" data-room="shared">Shared Room</button></li>
                </ul>

                @php
                    $defaultSliderValue = 4; // Any Price by default
                    if (isset($filters['budget']) && $filters['budget'] !== '') {
                        $budgetVal = intval($filters['budget']);
                        if ($budgetVal <= 2000 || $budgetVal <= 4000) {
                            $defaultSliderValue = 1;
                        } elseif ($budgetVal <= 6000) {
                            $defaultSliderValue = 2;
                        } elseif ($budgetVal <= 10000) {
                            $defaultSliderValue = 3;
                        } else {
                            $defaultSliderValue = 4;
                        }
                    }
                @endphp

                <div class="filter-section">
                    <h4>Max Monthly Rent</h4>
                    <div class="price-range">
                        <div class="price-values">
                            <span>₱2,000</span>
                            <span id="price-range-label">
                                @if($defaultSliderValue == 1)
                                    ₱2,000 - ₱4,000
                                @elseif($defaultSliderValue == 2)
                                    ₱4,000 - ₱6,000
                                @elseif($defaultSliderValue == 3)
                                    ₱6,000 - ₱10,000
                                @else
                                    Any
                                @endif
                            </span>
                        </div>
                        <input id="price-range-input" type="range" min="1" max="4" step="1" value="{{ $defaultSliderValue }}">
                    </div>
                </div>

                <div class="filter-section" style="margin-top: 18px;">
                    <h4>Availability</h4>
                    <div class="availability-toggle">
                        <button class="pill active" type="button">All</button>
                        <button class="pill" type="button">Available Now</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="cards-grid">
            @forelse($boardingHouses as $house)
                @php
                    $price = $house->price_per_month;
                    if ($price <= 4000) $priceRange = '1';
                    elseif ($price <= 6000) $priceRange = '2';
                    elseif ($price <= 10000) $priceRange = '3';
                    else $priceRange = '4';

                    $images = [
                        'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=800&q=80',
                        'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=800&q=80',
                        'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=800&q=80',
                    ];
                    $image = $images[$house->id % count($images)];
                @endphp
                <article class="room-card"
                    data-city="{{ $house->city->name ?? 'Unknown' }}"
                    data-type="{{ $house->room_type }}"
                    data-availability="{{ ($house->is_available && $house->available_beds > 0) ? 'available' : 'booked' }}"
                    data-price-range="{{ $priceRange }}">
                    <img src="{{ $image }}" alt="{{ $house->name }}">
                    <div class="card-actions">
                        <a href="{{ route('boarding-houses.edit', $house->id) }}" class="card-action-btn btn-edit" title="Edit">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </a>
                        <form action="{{ route('boarding-houses.destroy', $house->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Are you sure you want to delete this boarding house?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="card-action-btn btn-delete" title="Delete">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            </button>
                        </form>
                    </div>
                    <div class="room-card-body">
                        <div class="room-card-tags">
                            <span class="tag">{{ ucfirst($house->room_type) }}</span>
                            @if($house->available_beds > 0)
                                <span class="tag">{{ $house->available_beds }} / {{ $house->total_beds }} Beds Avail</span>
                            @else
                                <span class="tag booked">Fully Booked</span>
                            @endif
                        </div>
                        <div>
                            <h2 class="room-card-title">{{ $house->name }}</h2>
                            <p class="room-card-subtitle">{{ $house->location }}, {{ $house->city->name ?? '' }}</p>
                            @if($house->rating)
                                <div class="room-rating" style="margin-top: 6px; gap: 2px;">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span style="color: {{ $i <= $house->rating ? '#f59e0b' : '#d1d5db' }}; font-size: 1.1rem; line-height: 1;">★</span>
                                    @endfor
                                    <span style="font-size: 0.8rem; color: #6b7280; margin-left: 4px;">({{ $house->rating }}/5)</span>
                                </div>
                            @endif
                            @if($house->description)
                                <p class="room-card-description" style="margin-top: 8px; font-size: 0.85rem; color: #4b5563; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 2.8em;" title="{{ $house->description }}">
                                    {{ $house->description }}
                                </p>
                            @else
                                <p class="room-card-description" style="margin-top: 8px; font-size: 0.85rem; color: #9ca3af; font-style: italic; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 2.8em; user-select: none;">
                                    No description provided.
                                </p>
                            @endif
                        </div>
                        <div class="room-card-meta">
                            <div class="meta-item" style="display: flex; flex-direction: column; gap: 2px;">
                                <span style="font-size: 0.7rem; text-transform: uppercase; color: #9ca3af; font-weight: 700;">Total Beds</span>
                                <span style="font-weight: 700; color: #374151;">{{ $house->total_beds }} Beds</span>
                            </div>
                            <div class="meta-item" style="display: flex; flex-direction: column; gap: 2px;">
                                <span style="font-size: 0.7rem; text-transform: uppercase; color: #9ca3af; font-weight: 700;">Available</span>
                                <span style="font-weight: 700; color: {{ $house->available_beds > 0 ? '#16a34a' : '#dc2626' }};">{{ $house->available_beds }} Beds</span>
                            </div>
                            <div class="meta-item" style="display: flex; flex-direction: column; gap: 2px;">
                                <span style="font-size: 0.7rem; text-transform: uppercase; color: #9ca3af; font-weight: 700;">Occupied</span>
                                <span style="font-weight: 700; color: #4b5563;">{{ $house->total_beds - $house->available_beds }} Beds</span>
                            </div>
                            <div class="meta-item" style="display: flex; flex-direction: column; gap: 2px;">
                                <span style="font-size: 0.7rem; text-transform: uppercase; color: #9ca3af; font-weight: 700;">Room Size</span>
                                <span style="font-weight: 700; color: #4b5563;">{{ $house->size_sqm ?? '—' }} sqm</span>
                            </div>
                        </div>
                        <div class="room-card-footer">
                            <div class="room-price">₱{{ number_format($house->price_per_month, 0) }}/mo</div>
                            @if($house->available_beds > 0)
                                <button type="button" class="btn-rent" onclick="openRentModal({{ json_encode($house->load('city')) }})">Rent Room</button>
                            @else
                                <button type="button" class="btn-rent btn-disabled" disabled>Full</button>
                            @endif
                        </div>
                    </div>
                </article>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 16px;">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    <h3 style="color: #6b7280; font-size: 1.1rem; margin-bottom: 8px;">No boarding houses yet</h3>
                    <p style="color: #9ca3af; font-size: 0.9rem; margin-bottom: 20px;">Be the first to add a listing!</p>
                    <a href="{{ route('boarding-houses.create') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background: linear-gradient(135deg, #22c77a 0%, #16a34a 100%); color: white; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 0.95rem; transition: all 0.2s;">
                        + Add Boarding House
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Rent Modal -->
    <div id="rentModal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Rent Room</h3>
                <button class="modal-close" onclick="closeRentModal()">&times;</button>
            </div>
            <form id="rentForm" action="{{ route('rentals.store') }}" method="POST">
                @csrf
                <input type="hidden" name="boarding_house_id" id="modal_boarding_house_id">
                
                <div style="margin-bottom: 20px; background: #f9fafb; padding: 14px; border-radius: 12px; border: 1px solid #f3f4f6;">
                    <p style="margin: 0 0 6px; font-size: 0.85rem; color: #6b7280; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Boarding House</p>
                    <h4 id="modal_house_name" style="margin: 0; font-size: 1.1rem; color: #111827; font-weight: 800;"></h4>
                    <p id="modal_house_location" style="margin: 4px 0 0; font-size: 0.88rem; color: #4b5563; display: flex; align-items: center; gap: 4px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span id="modal_house_location_text"></span>
                    </p>
                    <div id="modal_house_description_container" style="margin-top: 10px; padding-top: 10px; border-top: 1px dashed #e5e7eb; display: none;">
                        <p style="margin: 0 0 4px; font-size: 0.75rem; color: #888; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">About this place</p>
                        <p id="modal_house_description" style="margin: 0; font-size: 0.85rem; color: #4b5563; line-height: 1.4; white-space: pre-line;"></p>
                    </div>
                </div>

                <div class="modal-form-group">
                    <label for="tenant_name">Full Name</label>
                    <input type="text" name="tenant_name" id="tenant_name" required placeholder="Enter your full name">
                </div>

                <div class="modal-form-group">
                    <label for="tenant_email">Email Address</label>
                    <input type="email" name="tenant_email" id="tenant_email" placeholder="e.g. juan@email.com">
                </div>

                <div class="modal-form-group">
                    <label for="tenant_contact">Contact Number</label>
                    <input type="text" name="tenant_contact" id="tenant_contact" placeholder="e.g. 09987654321">
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-modal-cancel" onclick="closeRentModal()">Cancel</button>
                    <button type="submit" class="btn-modal-submit">Confirm Rental</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const priceRanges = {
                '1': { label: '₱2,000 - ₱4,000' },
                '2': { label: '₱4,000 - ₱6,000' },
                '3': { label: '₱6,000 - ₱10,000' },
                '4': { label: '₱10,000+' }
            };

            const priceInput = document.getElementById('price-range-input');
            const priceLabel = document.getElementById('price-range-label');
            const cityButtons = document.querySelectorAll('.city-list button');
            const roomButtons = document.querySelectorAll('.room-list button');
            const availabilityButtons = document.querySelectorAll('.availability-toggle .pill');
            const cards = Array.from(document.querySelectorAll('.room-card'));

            const activeCityBtn = document.querySelector('.city-list button.active');
            const activeRoomBtn = document.querySelector('.room-list button.active');

            let selectedCity = activeCityBtn ? activeCityBtn.dataset.city : 'All';
            let selectedRoom = activeRoomBtn ? activeRoomBtn.dataset.room : 'All';
            let selectedAvailability = 'All';
            let selectedPrice = priceInput.value;

            function setActive(buttons, activeButton) {
                buttons.forEach(button => {
                    button.classList.toggle('active', button === activeButton);
                });
            }

            function updatePriceDisplay() {
                const label = selectedPrice === '4' ? 'Any' : priceRanges[selectedPrice].label;
                priceLabel.textContent = label;
            }

            function filterCards() {
                const selectedRangeLabel = selectedPrice === '4' ? 'Any' : priceRanges[selectedPrice].label;
                priceLabel.textContent = selectedRangeLabel;

                cards.forEach(card => {
                    const cardCity = card.dataset.city || 'All';
                    const cardRoom = card.dataset.type || 'All';
                    const cardAvailability = card.dataset.availability || 'available';
                    const cardPriceRange = card.dataset.priceRange || '1';

                    const matchesCity = selectedCity === 'All' || selectedCity === cardCity;
                    const matchesRoom = selectedRoom === 'All' || selectedRoom === cardRoom;
                    const matchesAvailability = selectedAvailability === 'All' || (selectedAvailability === 'Available Now' && cardAvailability === 'available');
                    const matchesPrice = selectedPrice === '4' ? true : cardPriceRange === selectedPrice;

                    card.style.display = matchesCity && matchesRoom && matchesAvailability && matchesPrice ? '' : 'none';
                });

                updatePriceDisplay();
            }

            priceInput.addEventListener('input', function() {
                selectedPrice = this.value;
                filterCards();
            });

            cityButtons.forEach(button => {
                button.addEventListener('click', function() {
                    selectedCity = this.dataset.city;
                    setActive(cityButtons, this);
                    filterCards();
                });
            });

            roomButtons.forEach(button => {
                button.addEventListener('click', function() {
                    selectedRoom = this.dataset.room;
                    setActive(roomButtons, this);
                    filterCards();
                });
            });

            availabilityButtons.forEach(button => {
                button.addEventListener('click', function() {
                    selectedAvailability = this.textContent.trim();
                    setActive(availabilityButtons, this);
                    filterCards();
                });
            });

            filterCards();
        });

        // Global functions for Rent Modal
        function openRentModal(house) {
            document.getElementById('modal_boarding_house_id').value = house.id;
            document.getElementById('modal_house_name').textContent = house.name;
            
            const locationText = house.location + (house.city ? ', ' : '') + (house.city ? house.city.name : '');
            document.getElementById('modal_house_location_text').textContent = locationText;
            
            const descContainer = document.getElementById('modal_house_description_container');
            const descText = document.getElementById('modal_house_description');
            if (house.description) {
                descText.textContent = house.description;
                descContainer.style.display = 'block';
            } else {
                descContainer.style.display = 'none';
            }
            
            const modal = document.getElementById('rentModal');
            modal.style.display = 'flex';
            // Force a reflow
            modal.offsetHeight;
            modal.classList.add('active');
        }

        function closeRentModal() {
            const modal = document.getElementById('rentModal');
            modal.classList.remove('active');
            setTimeout(() => {
                modal.style.display = 'none';
                // Reset form values
                document.getElementById('rentForm').reset();
            }, 200);
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Boarding House - BoardingPH</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Manrope', sans-serif;
            background: #f0f2f5;
            color: #111827;
            min-height: 100vh;
        }

        /* ─── NAVBAR ─── */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 60px;
            background: rgba(0,0,0,0.92);
            backdrop-filter: blur(12px);
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

        .nav-links a:hover { color: white; }

        .nav-links a.active {
            background: white;
            color: #111;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
        }

        .btn-list-nav {
            background: #22c77a;
            color: white;
            padding: 10px 22px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: background 0.2s;
        }

        .btn-list-nav:hover { background: #1da862; }

        /* ─── PAGE CONTENT ─── */
        .page-container {
            max-width: 720px;
            margin: 0 auto;
            padding: 110px 20px 60px;
        }

        .page-header {
            margin-bottom: 32px;
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            margin-bottom: 6px;
        }

        .page-header p {
            color: #6b7280;
            font-size: 0.95rem;
        }

        /* ─── FLASH MESSAGES ─── */
        .alert {
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        .alert-error ul {
            margin: 6px 0 0 16px;
            font-weight: 400;
        }

        /* ─── FORM CARD ─── */
        .form-card {
            background: white;
            border-radius: 20px;
            padding: 36px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.08);
        }

        .form-section-title {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #9ca3af;
            margin-bottom: 16px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f3f4f6;
        }

        .form-grid {
            display: grid;
            gap: 20px;
            margin-bottom: 28px;
        }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.95rem;
            font-family: 'Manrope', sans-serif;
            color: #111827;
            background: #fafbfc;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #22c77a;
            box-shadow: 0 0 0 3px rgba(34, 199, 122, 0.12);
            background: white;
        }

        .form-group input.is-invalid,
        .form-group select.is-invalid,
        .form-group textarea.is-invalid {
            border-color: #ef4444;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group select {
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23999' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px;
        }

        .form-error {
            font-size: 0.78rem;
            color: #ef4444;
            font-weight: 500;
        }

        /* ─── RADIO GROUP ─── */
        .radio-group {
            display: flex;
            gap: 12px;
        }

        .radio-option {
            flex: 1;
            position: relative;
        }

        .radio-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .radio-option label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 16px;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600;
            color: #374151;
            background: #fafbfc;
            transition: all 0.2s;
        }

        .radio-option input[type="radio"]:checked + label {
            border-color: #22c77a;
            background: #ecfdf5;
            color: #065f46;
            box-shadow: 0 0 0 3px rgba(34, 199, 122, 0.12);
        }

        .radio-option label:hover {
            border-color: #d1d5db;
            background: #f9fafb;
        }

        .radio-option label svg {
            width: 18px;
            height: 18px;
        }

        /* ─── CHECKBOX ─── */
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 18px;
            background: #ecfdf5;
            border-radius: 12px;
            border: 1.5px solid #a7f3d0;
            cursor: pointer;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #22c77a;
            cursor: pointer;
        }

        .checkbox-group span {
            font-size: 0.9rem;
            font-weight: 600;
            color: #065f46;
        }

        /* ─── FORM ACTIONS ─── */
        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #f3f4f6;
        }

        .btn-submit {
            flex: 1;
            padding: 14px 28px;
            background: linear-gradient(135deg, #22c77a 0%, #16a34a 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            font-family: 'Manrope', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(34, 199, 122, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit svg {
            width: 18px;
            height: 18px;
        }

        .btn-cancel {
            padding: 14px 28px;
            background: white;
            color: #374151;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Manrope', sans-serif;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: all 0.2s;
        }

        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: 4px;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            font-size: 2.2rem;
            color: #d1d5db;
            cursor: pointer;
            transition: color 0.15s ease-in-out;
            line-height: 1;
        }

        .star-rating label:hover,
        .star-rating label:hover ~ label,
        .star-rating input:checked ~ label {
            color: #f59e0b;
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 768px) {
            .navbar {
                padding: 16px 20px;
            }
            .nav-links { display: none; }

            .page-container {
                padding: 90px 16px 40px;
            }

            .form-card {
                padding: 24px;
            }

            .form-grid-2 {
                grid-template-columns: 1fr;
            }

            .radio-group {
                flex-direction: column;
            }

            .form-actions {
                flex-direction: column-reverse;
            }
        }
    </style>
</head>
<body>

    {{-- ─── NAVBAR ─── --}}
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

        <a href="/listings" class="btn-list-nav">← Back to Listings</a>
    </nav>

    {{-- ─── MAIN ─── --}}
    <div class="page-container">

        <div class="page-header">
            <h1>Edit Boarding House</h1>
            <p>Update the details for <strong>{{ $boardingHouse->name }}</strong>.</p>
        </div>

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="alert alert-error">
                <div>
                    <strong>Please fix the following errors:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('boarding-houses.update', $boardingHouse->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-card">

                {{-- ─── LOCATION INFO ─── --}}
                <div class="form-section-title">Location Information</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="city_id">Area</label>
                        <select name="city_id" id="city_id" required>
                            <option value="">Select a city…</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id', $boardingHouse->city_id) == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Boarding House Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $boardingHouse->name) }}" placeholder="e.g. Sunrise Boarding House" required>
                        @error('name')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="location">Full Address / Landmark</label>
                        <input type="text" name="location" id="location" value="{{ old('location', $boardingHouse->location) }}" placeholder="e.g. 123 Rizal St, Brgy. San Antonio" required>
                        @error('location')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- ─── ROOM DETAILS ─── --}}
                <div class="form-section-title">Room Details</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Room Type</label>
                        <div class="radio-group">
                            <div class="radio-option">
                                <input type="radio" name="room_type" id="room_single" value="single"
                                    {{ old('room_type', $boardingHouse->room_type) === 'single' ? 'checked' : '' }}>
                                <label for="room_single">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16"/>
                                        <path d="M12 11a3 3 0 100-6 3 3 0 000 6z"/>
                                    </svg>
                                    Single Room
                                </label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" name="room_type" id="room_shared" value="shared"
                                    {{ old('room_type', $boardingHouse->room_type) === 'shared' ? 'checked' : '' }}>
                                <label for="room_shared">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                        <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                                        <path d="M16 3.13a4 4 0 010 7.75"/>
                                    </svg>
                                    Shared Room
                                </label>
                            </div>
                        </div>
                        @error('room_type')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="total_beds">Total Beds</label>
                            <input type="number" name="total_beds" id="total_beds" value="{{ old('total_beds', $boardingHouse->total_beds) }}" min="1" placeholder="e.g. 4" required>
                            @error('total_beds')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="available_beds">Available Beds</label>
                            <input type="number" name="available_beds" id="available_beds" value="{{ old('available_beds', $boardingHouse->available_beds) }}" min="0" placeholder="e.g. 2" required>
                            @error('available_beds')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="size_sqm">Room Size (sqm)</label>
                            <input type="number" step="0.01" name="size_sqm" id="size_sqm" value="{{ old('size_sqm', $boardingHouse->size_sqm) }}" placeholder="e.g. 18">
                            @error('size_sqm')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price_per_month">Monthly Rent (₱)</label>
                            <input type="number" step="0.01" name="price_per_month" id="price_per_month" value="{{ old('price_per_month', $boardingHouse->price_per_month) }}" placeholder="e.g. 5000" required>
                            @error('price_per_month')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <div class="checkbox-group">
                                <input type="hidden" name="is_available" value="0">
                                <input type="checkbox" name="is_available" value="1"
                                    {{ old('is_available', $boardingHouse->is_available) == '1' ? 'checked' : '' }}>
                                <span>Available for Rent</span>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- ─── DESCRIPTION ─── --}}
                <div class="form-section-title">Additional Info</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Rating (1-5 Stars)</label>
                        <div class="star-rating">
                            <input type="radio" name="rating" id="star5" value="5" {{ old('rating', $boardingHouse->rating) == 5 ? 'checked' : '' }} />
                            <label for="star5" title="5 stars">★</label>
                            
                            <input type="radio" name="rating" id="star4" value="4" {{ old('rating', $boardingHouse->rating) == 4 ? 'checked' : '' }} />
                            <label for="star4" title="4 stars">★</label>
                            
                            <input type="radio" name="rating" id="star3" value="3" {{ old('rating', $boardingHouse->rating) == 3 ? 'checked' : '' }} />
                            <label for="star3" title="3 stars">★</label>
                            
                            <input type="radio" name="rating" id="star2" value="2" {{ old('rating', $boardingHouse->rating) == 2 ? 'checked' : '' }} />
                            <label for="star2" title="2 stars">★</label>
                            
                            <input type="radio" name="rating" id="star1" value="1" {{ old('rating', $boardingHouse->rating) == 1 ? 'checked' : '' }} />
                            <label for="star1" title="1 star">★</label>
                        </div>
                        @error('rating')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description (Optional)</label>
                        <textarea name="description" id="description" placeholder="Describe the boarding house, amenities, rules, nearby landmarks…">{{ old('description', $boardingHouse->description) }}</textarea>
                        @error('description')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- ─── ACTIONS ─── --}}
                <div class="form-actions">
                    <a href="/listings" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v14a2 2 0 01-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/>
                            <polyline points="7 3 7 8 15 8"/>
                        </svg>
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>

</body>
</html>

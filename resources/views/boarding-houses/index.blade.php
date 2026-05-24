@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Boarding Houses</h1>
    <a href="{{ route('boarding-houses.create') }}" class="btn btn-primary">Add New Boarding House</a>

    <div class="row mt-4">
        @foreach($boardingHouses as $house)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5>{{ $house->name }}</h5>
                    <p><strong>{{ $house->city->name ?? 'N/A' }}</strong> - {{ $house->location }}</p>
                    <p>{{ Str::limit($house->description, 100) }}</p>
                    <p>Room: {{ ucfirst($house->room_type) }} | Beds: {{ $house->available_beds }}/{{ $house->total_beds }}</p>
                    <p>Size: {{ $house->size_sqm }} sqm | ₱{{ number_format($house->price_per_month, 2) }}/month</p>
                    <span class="badge {{ $house->is_available ? 'bg-success' : 'bg-secondary' }}">
                        {{ $house->is_available ? 'Available' : 'Not Available' }}
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
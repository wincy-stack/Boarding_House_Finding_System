<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingHouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'name',
        'description',
        'location',
        'room_type',
        'total_beds',
        'available_beds',
        'size_sqm',
        'price_per_month',
        'is_available',
        'rating',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }
}
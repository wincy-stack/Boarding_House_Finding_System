<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'boarding_house_id',
        'tenant_name',
        'tenant_phone',
        'tenant_email',
        'tenant_contact',
        'rental_date',
        'price_per_month',
        'status',
    ];

    protected $casts = [
        'rental_date' => 'datetime',
    ];

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }
}

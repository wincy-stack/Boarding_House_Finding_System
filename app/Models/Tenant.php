<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'boarding_house_id',
        'name',
        'email',
        'contact',
        'room_number',
        'move_in_date',
        'status',
    ];

    protected $casts = [
        'move_in_date' => 'date',
    ];

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}

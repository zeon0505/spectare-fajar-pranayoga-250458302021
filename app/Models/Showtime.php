<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    use HasFactory;

    protected $fillable = ['film_id', 'studio_id', 'starts_at', 'price'];

    protected $casts = [
        'starts_at' => 'datetime',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

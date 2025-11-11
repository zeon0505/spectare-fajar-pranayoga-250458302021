<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'synopsis', 'poster', 'duration',
        'genre', 'director', 'cast', 'status'
    ];

    protected $casts = [
        'cast' => 'array',
    ];

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function genre()
{
         return $this->belongsTo(Genre::class);
}}

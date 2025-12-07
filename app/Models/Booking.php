<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Support\Facades\Storage;

class Booking extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['user_id', 'showtime_id', 'booking_code', 'status', 'total_price', 'qr_code_path', 'voucher_id', 'discount_amount', 'cancellation_reason', 'refunded_at', 'cancelled_at'];

    protected $casts = [
        'refunded_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    // Accessor for qr_code - reads SVG from storage
    public function getQrCodeAttribute()
    {
        if ($this->qr_code_path && Storage::disk('public')->exists($this->qr_code_path)) {
            return Storage::disk('public')->get($this->qr_code_path);
        }
        return null;
    }

    // Mutator for qr_code - saves SVG to storage
    public function setQrCodeAttribute($value)
    {
        if ($value) {
            $path = 'qrcodes/' . $this->id . '.svg';
            Storage::disk('public')->put($path, $value);
            $this->attributes['qr_code_path'] = $path;
        }
    }

    public function canBeCancelled(): bool
    {
        if ($this->status !== 'confirmed' && $this->status !== 'paid') {
            return false;
        }
        
        // Check if showtime start time is more than 1 hour from now
        return $this->showtime->start_time->gt(now()->addHour());
    }

    public function cancel(string $reason)
    {
        \Illuminate\Support\Facades\DB::transaction(function () use ($reason) {
            $this->update([
                'status' => 'cancelled',
                'cancellation_reason' => $reason,
                'cancelled_at' => now(),
                'refunded_at' => now(),
            ]);

            // Refund to user wallet
            // Assuming 100% refund for now
            $this->user->deposit($this->total_price - $this->discount_amount);
        });
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function showtime()
    {
        return $this->belongsTo(Showtime::class);
    }

    public function seats()
    {
        return $this->hasMany(BookingSeat::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}

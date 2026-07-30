<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'payment_no',
        'donation_id',
        'payment_method',
        'payment_gateway',
        'transaction_id',
        'gateway_reference',
        'amount',
        'currency',
        'status',
        'gateway_response',
        'initiated_at',
        'paid_at',
        'failed_at',
        'payer_note',
        'verified_by',
        'verified_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'gateway_response' => 'array',
        'initiated_at' => 'datetime',
        'paid_at' => 'datetime',
        'failed_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Payment $payment) {
            if (empty($payment->uuid)) {
                $payment->uuid = (string) Str::uuid();
            }

            if (empty($payment->payment_no)) {
                $payment->payment_no =
                    'PAY-' .
                    now()->format('YmdHis') .
                    '-' .
                    strtoupper(Str::random(6));
            }
        });
    }

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function receipt()
    {
        return $this->hasOne(
            Receipt::class
        );
    }
}
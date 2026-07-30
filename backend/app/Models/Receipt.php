<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'receipt_no',
        'donation_id',
        'payment_id',
        'amount',
        'currency',
        'issued_at',
        'pdf_path',
        'email_sent_at',
        'sms_sent_at',
        'is_verified',
        'created_by',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
        'email_sent_at' => 'datetime',
        'sms_sent_at' => 'datetime',
        'is_verified' => 'boolean',
    ];

    public function donation()
    {
        return $this->belongsTo(
            Donation::class
        );
    }

    public function payment()
    {
        return $this->belongsTo(
            Payment::class
        );
    }

    public function creator()
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }

    public function files()
    {
        return $this->morphMany(
            File::class,
            'fileable'
        );
    }
}
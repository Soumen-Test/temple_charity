<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Donation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'donation_no',
        'donor_id',
        'project_id',
        'campaign_id',
        'amount',
        'currency',
        'donation_type',
        'is_anonymous',
        'status',
        'donated_at',
        'donor_note',
        'created_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'is_anonymous' => 'boolean',
        'donated_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Donation $donation) {

            if (empty($donation->uuid)) {
                $donation->uuid = (string) Str::uuid();
            }

            if (empty($donation->donation_no)) {
                $donation->donation_no =
                    'DON-' . now()->format('YmdHis')
                    . '-' . strtoupper(Str::random(6));
            }
        });
    }

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
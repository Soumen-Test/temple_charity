<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Temple extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'organization_id',
        'name',
        'code',
        'description',
        'priest_name',
        'priest_mobile',
        'email',
        'phone',
        'address',
        'country',
        'district',
        'division',
        'latitude',
        'longitude',
        'google_map_url',
        'established_date',
        'logo_path',
        'is_active',
        'created_by',
        'updated_by',
        'remarks',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'established_date' => 'date',
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    protected static function booted(): void
    {
        static::creating(function (Temple $temple) {
            if (empty($temple->uuid)) {
                $temple->uuid = (string) Str::uuid();
            }
            if (empty($temple->code)) {
                $temple->code = 'TEM-' . strtoupper(
                    Str::random(8)
                );
            }
        });
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Organization extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'short_name',
        'registration_no',
        'email',
        'phone',
        'website',
        'address',
        'country',
        'district',
        'division',
        'logo_path',
        'is_active',
        'created_by',
        'updated_by',
        'remarks',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Organization $organization) {
            if (empty($organization->uuid)) {
                $organization->uuid = (string) Str::uuid();
            }
        });
    }

    public function temples()
    {
        return $this->hasMany(Temple::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
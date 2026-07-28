<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'organization_id',
        'temple_id',
        'name',
        'slug',
        'project_code',
        'project_type',
        'short_description',
        'description',
        'target_amount',
        'target_beneficiaries',
        'start_date',
        'end_date',
        'is_public',
        'is_featured',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_public' => 'boolean',
        'is_featured' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Project $project) {

            if (empty($project->uuid)) {
                $project->uuid = (string) Str::uuid();
            }

            if (empty($project->slug)) {
                $project->slug = Str::slug($project->name);
            }
        });
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function temple()
    {
        return $this->belongsTo(Temple::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
    
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
    
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
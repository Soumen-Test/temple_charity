<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignSponsor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'campaign_id',
        'name',
        'organization_name',
        'mobile',
        'email',
        'sponsor_type',
        'description',
        'is_public',
        'is_featured',
        'is_active',
        'sort_order',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Campaign
    |--------------------------------------------------------------------------
    */

    public function campaign()
    {
        return $this->belongsTo(
            Campaign::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Created By
    |--------------------------------------------------------------------------
    */

    public function creator()
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Updated By
    |--------------------------------------------------------------------------
    */

    public function updater()
    {
        return $this->belongsTo(
            User::class,
            'updated_by'
        );
    }
}
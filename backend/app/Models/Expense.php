<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'expense_no',
        'organization_id',
        'temple_id',
        'project_id',
        'campaign_id',
        'expense_date',
        'title',
        'description',
        'expense_category',
        'amount',
        'currency',
        'payment_method',
        'reference_no',
        'status',
        'submitted_by',
        'approved_by',
        'submitted_at',
        'approved_at',
        'approval_remarks',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'expense_date' => 'date',
        'amount' => 'decimal:2',
        'submitted_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Organization
    |--------------------------------------------------------------------------
    */

    public function organization()
    {
        return $this->belongsTo(
            Organization::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Temple
    |--------------------------------------------------------------------------
    */

    public function temple()
    {
        return $this->belongsTo(
            Temple::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Project
    |--------------------------------------------------------------------------
    */

    public function project()
    {
        return $this->belongsTo(
            Project::class
        );
    }

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
    | Submitted By
    |--------------------------------------------------------------------------
    */

    public function submitter()
    {
        return $this->belongsTo(
            User::class,
            'submitted_by'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Approved By
    |--------------------------------------------------------------------------
    */

    public function approver()
    {
        return $this->belongsTo(
            User::class,
            'approved_by'
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

    /*
    |--------------------------------------------------------------------------
    | Files
    |--------------------------------------------------------------------------
    */

    public function files()
    {
        return $this->morphMany(
            File::class,
            'fileable'
        );
    }
}
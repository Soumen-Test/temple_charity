<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'fileable_type',
        'fileable_id',
        'original_name',
        'file_name',
        'disk',
        'path',
        'mime_type',
        'extension',
        'size',
        'width',
        'height',
        'collection',
        'is_public',
        'uploaded_by',
        'remarks',
    ];

    protected $casts = [
        'size' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
        'is_public' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Polymorphic Relationship
    |--------------------------------------------------------------------------
    */

    public function fileable()
    {
        return $this->morphTo();
    }

    /*
    |--------------------------------------------------------------------------
    | Uploaded By
    |--------------------------------------------------------------------------
    */

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }
}
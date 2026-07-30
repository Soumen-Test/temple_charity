<?php

namespace App\Http\Resources\Api\V1\File;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'original_name' =>
                $this->original_name,

            'file_name' =>
                $this->file_name,

            'disk' =>
                $this->disk,

            'path' =>
                $this->path,

            'url' =>
                $this->is_public
                    ? Storage::disk($this->disk)
                        ->url($this->path)
                    : null,

            'mime_type' =>
                $this->mime_type,

            'extension' =>
                $this->extension,

            'size' =>
                $this->size,

            'width' =>
                $this->width,

            'height' =>
                $this->height,

            'collection' =>
                $this->collection,

            'is_public' =>
                $this->is_public,

            'uploaded_by' =>
                $this->uploaded_by,

            'remarks' =>
                $this->remarks,

            'created_at' =>
                $this->created_at,
        ];
    }
}
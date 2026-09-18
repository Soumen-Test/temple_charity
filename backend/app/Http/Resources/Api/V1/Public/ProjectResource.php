<?php

namespace App\Http\Resources\Api\V1\Public;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [

            'uuid' =>
                $this->uuid,

            'name' =>
                $this->name,

            'slug' =>
                $this->slug,

            'short_description' =>
                $this->short_description,

            'description' =>
                $this->description,

            'target_amount' =>
                (float) $this->target_amount,

            'status' =>
                $this->status,

            'is_featured' =>
                $this->is_featured,

            'campaigns' =>
                $this->whenLoaded(
                    'campaigns'
                ),
        ];
    }
}
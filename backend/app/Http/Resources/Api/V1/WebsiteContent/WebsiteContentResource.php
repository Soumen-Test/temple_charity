<?php

namespace App\Http\Resources\Api\V1\WebsiteContent;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WebsiteContentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [

            'id' =>
                $this->id,

            'uuid' =>
                $this->uuid,

            'organization_id' =>
                $this->organization_id,

            'temple_id' =>
                $this->temple_id,

            'content_key' =>
                $this->content_key,

            'content_type' =>
                $this->content_type,

            'content_value' =>
                $this->content_value,

            'title' =>
                $this->title,

            'description' =>
                $this->description,

            'is_public' =>
                $this->is_public,

            'is_active' =>
                $this->is_active,

            'sort_order' =>
                $this->sort_order,

            'created_by' =>
                $this->created_by,

            'updated_by' =>
                $this->updated_by,

            'created_at' =>
                $this->created_at,

            'updated_at' =>
                $this->updated_at,

            'organization' =>
                $this->whenLoaded(
                    'organization'
                ),

            'temple' =>
                $this->whenLoaded(
                    'temple'
                ),
        ];
    }
}
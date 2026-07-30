<?php

namespace App\Http\Resources\Api\V1\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'uuid' => $this->uuid,

            'code' => $this->code,

            'organization' => $this->whenLoaded(
                'organization',
                function () {
                    return [
                        'id' => $this->organization->id,
                        'name' => $this->organization->name,
                    ];
                }
            ),

            'temple' => $this->whenLoaded(
                'temple',
                function () {
                    return [
                        'id' => $this->temple->id,
                        'name' => $this->temple->name,
                    ];
                }
            ),

            'name' => $this->name,

            'slug' => $this->slug,

            'short_description' =>
                $this->short_description,

            'description' => $this->description,

            'project_type' => $this->project_type,

            'start_date' => $this->start_date,

            'end_date' => $this->end_date,

            'target_amount' => $this->target_amount,

            'target_beneficiaries' =>
                $this->target_beneficiaries,

            'cover_image_path' =>
                $this->cover_image_path,

            'status' => $this->status,

            'is_public' => $this->is_public,

            'is_active' => $this->is_active,

            'remarks' => $this->remarks,

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,
        ];
    }
}
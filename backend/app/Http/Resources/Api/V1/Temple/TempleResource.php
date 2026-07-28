<?php

namespace App\Http\Resources\Api\V1\Temple;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TempleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'uuid' => $this->uuid,

            'organization_id' => $this->organization_id,

            'name' => $this->name,

            'address' => $this->address,

            'district' => $this->district,

            'division' => $this->division,

            'priest_name' => $this->priest_name,

            'priest_mobile' => $this->priest_mobile,

            'latitude' => $this->latitude,

            'longitude' => $this->longitude,

            'google_map_url' => $this->google_map_url,

            'image_path' => $this->image_path,

            'is_active' => $this->is_active,

            'remarks' => $this->remarks,

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,
        ];
    }
}
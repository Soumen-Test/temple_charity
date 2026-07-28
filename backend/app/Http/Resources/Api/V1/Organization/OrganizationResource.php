<?php

namespace App\Http\Resources\Api\V1\Organization;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'uuid' => $this->uuid,

            'name' => $this->name,

            'short_name' => $this->short_name,

            'registration_no' => $this->registration_no,

            'email' => $this->email,

            'phone' => $this->phone,

            'website' => $this->website,

            'address' => $this->address,

            'country' => $this->country,

            'district' => $this->district,

            'division' => $this->division,

            'logo_path' => $this->logo_path,

            'is_active' => $this->is_active,

            'remarks' => $this->remarks,

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,
        ];
    }
}
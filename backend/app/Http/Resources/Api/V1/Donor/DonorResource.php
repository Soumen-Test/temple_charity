<?php

namespace App\Http\Resources\Api\V1\Donor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DonorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'uuid' => $this->uuid,

            'name' => $this->name,

            'mobile' => $this->mobile,

            'email' => $this->email,

            'address' => $this->address,

            'district' => $this->district,

            'country' => $this->country,

            'is_anonymous' => $this->is_anonymous,

            'user_id' => $this->user_id,

            'is_active' => $this->is_active,

            /*
            |--------------------------------------------------------------------------
            | Donation Summary
            |--------------------------------------------------------------------------
            */

            'donation_count' => $this->when(
                isset($this->donation_count),
                $this->donation_count
            ),

            'total_donation' => $this->when(
                isset($this->total_donation),
                number_format(
                    (float) $this->total_donation,
                    2,
                    '.',
                    ''
                )
            ),

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,
        ];
    }
}
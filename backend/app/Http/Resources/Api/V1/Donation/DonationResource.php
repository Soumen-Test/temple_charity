<?php

namespace App\Http\Resources\Api\V1\Donation;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DonationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'uuid' => $this->uuid,

            'donation_no' => $this->donation_no,

            'donor' => $this->whenLoaded(
                'donor',
                function () {
                    return [
                        'id' => $this->donor->id,
                        'uuid' => $this->donor->uuid,
                        'name' => $this->donor->name,
                        'mobile' => $this->donor->mobile,
                        'email' => $this->donor->email,
                    ];
                }
            ),

            'project' => $this->whenLoaded(
                'project',
                function () {
                    return [
                        'id' => $this->project->id,
                        'uuid' => $this->project->uuid,
                        'code' => $this->project->code,
                        'name' => $this->project->name,
                    ];
                }
            ),

            'campaign' => $this->whenLoaded(
                'campaign',
                function () {
                    return [
                        'id' => $this->campaign->id,
                        'uuid' => $this->campaign->uuid,
                        'campaign_code' =>
                            $this->campaign->campaign_code,
                        'name' => $this->campaign->name,
                    ];
                }
            ),

            'amount' => $this->amount,

            'currency' => $this->currency,

            'donation_type' => $this->donation_type,

            'is_anonymous' => $this->is_anonymous,

            'status' => $this->status,

            'donated_at' => $this->donated_at,

            'donor_note' => $this->donor_note,

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,
        ];
    }
}
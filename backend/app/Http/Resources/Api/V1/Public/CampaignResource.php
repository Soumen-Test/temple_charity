<?php

namespace App\Http\Resources\Api\V1\Public;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $collectedAmount = (float) ($this->collected_amount ?? 0);

        $targetAmount = (float) $this->target_amount;

        $remainingAmount = max(
            $targetAmount - $collectedAmount,
            0
        );

        $progressPercentage = $targetAmount > 0
            ? round(
                ($collectedAmount / $targetAmount) * 100,
                2
            )
            : 0;

        return [

            'uuid' =>
                $this->uuid,

            'name' =>
                $this->name,

            'slug' =>
                $this->slug,

            'campaign_code' =>
                $this->campaign_code,

            'short_description' =>
                $this->short_description,

            'description' =>
                $this->description,

            'target_amount' =>
                $targetAmount,

            'collected_amount' =>
                $collectedAmount,

            'remaining_amount' =>
                $remainingAmount,

            'progress_percentage' =>
                $progressPercentage,

            'start_date' =>
                $this->start_date,

            'end_date' =>
                $this->end_date,

            'is_featured' =>
                $this->is_featured,

            'status' =>
                $this->status,

            'project' =>
                $this->whenLoaded(
                    'project'
                ),
        ];
    }
}
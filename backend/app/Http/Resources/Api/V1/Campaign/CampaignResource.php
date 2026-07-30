<?php

namespace App\Http\Resources\Api\V1\Campaign;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $target = (float) $this->target_amount;

        $collected = (float) $this->donations()
            ->where('status', 'completed')
            ->sum('amount');

        $progress = $target > 0
            ? round(($collected / $target) * 100, 2)
            : 0;

        return [
            'id' => $this->id,

            'uuid' => $this->uuid,

            'campaign_code' =>
                $this->campaign_code,

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

            'name' => $this->name,

            'slug' => $this->slug,

            'short_description' =>
                $this->short_description,

            'description' =>
                $this->description,

            'target_amount' =>
                $this->target_amount,

            'collected_amount' =>
                number_format($collected, 2, '.', ''),

            'progress_percentage' =>
                $progress,

            'start_date' =>
                $this->start_date,

            'end_date' =>
                $this->end_date,

            'is_public' =>
                $this->is_public,

            'is_featured' =>
                $this->is_featured,

            'status' =>
                $this->status,

            'created_at' =>
                $this->created_at,

            'updated_at' =>
                $this->updated_at,
        ];
    }
}
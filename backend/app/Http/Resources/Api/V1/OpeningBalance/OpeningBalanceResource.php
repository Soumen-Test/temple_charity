<?php

namespace App\Http\Resources\Api\V1\OpeningBalance;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OpeningBalanceResource extends JsonResource
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

            'financial_year' =>
                $this->financial_year,

            'amount' =>
                $this->amount,

            'currency' =>
                $this->currency,

            'opening_date' =>
                $this->opening_date,

            'status' =>
                $this->status,

            'remarks' =>
                $this->remarks,

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
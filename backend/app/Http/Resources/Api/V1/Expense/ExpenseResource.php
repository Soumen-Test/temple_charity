<?php

namespace App\Http\Resources\Api\V1\Expense;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' =>
                $this->id,

            'uuid' =>
                $this->uuid,

            'expense_no' =>
                $this->expense_no,

            'organization_id' =>
                $this->organization_id,

            'temple_id' =>
                $this->temple_id,

            'project_id' =>
                $this->project_id,

            'campaign_id' =>
                $this->campaign_id,

            'expense_date' =>
                $this->expense_date,

            'title' =>
                $this->title,

            'description' =>
                $this->description,

            'expense_category' =>
                $this->expense_category,

            'amount' =>
                $this->amount,

            'currency' =>
                $this->currency,

            'payment_method' =>
                $this->payment_method,

            'reference_no' =>
                $this->reference_no,

            'status' =>
                $this->status,

            'submitted_by' =>
                $this->submitted_by,

            'approved_by' =>
                $this->approved_by,

            'submitted_at' =>
                $this->submitted_at,

            'approved_at' =>
                $this->approved_at,

            'approval_remarks' =>
                $this->approval_remarks,

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

            'project' =>
                $this->whenLoaded(
                    'project'
                ),

            'campaign' =>
                $this->whenLoaded(
                    'campaign'
                ),

            'files' =>
                $this->whenLoaded(
                    'files'
                ),
        ];
    }
}
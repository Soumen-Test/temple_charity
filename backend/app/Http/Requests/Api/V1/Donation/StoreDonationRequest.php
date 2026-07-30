<?php

namespace App\Http\Requests\Api\V1\Donation;

use App\Models\Campaign;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreDonationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'donor_id' => [
                'nullable',
                'integer',
                'exists:donors,id',
            ],

            'project_id' => [
                'required',
                'integer',
                'exists:projects,id',
            ],

            'campaign_id' => [
                'nullable',
                'integer',
                'exists:campaigns,id',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:1',
            ],

            'currency' => [
                'sometimes',
                'string',
                'size:3',
            ],

            'donation_type' => [
                'sometimes',
                'string',
                'max:50',
                'in:one_time,recurring',
            ],

            'is_anonymous' => [
                'sometimes',
                'boolean',
            ],

            'donor_note' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {

                $projectId = $this->input('project_id');
                $campaignId = $this->input('campaign_id');

                if (!$projectId || !$campaignId) {
                    return;
                }

                $campaignBelongsToProject = Campaign::query()
                    ->where('id', $campaignId)
                    ->where('project_id', $projectId)
                    ->exists();

                if (!$campaignBelongsToProject) {
                    $validator->errors()->add(
                        'campaign_id',
                        'The selected campaign does not belong to the selected project.'
                    );
                }
            },
        ];
    }
}
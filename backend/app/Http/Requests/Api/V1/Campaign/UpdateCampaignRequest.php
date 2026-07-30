<?php

namespace App\Http\Requests\Api\V1\Campaign;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project_id' => [
                'sometimes',
                'required',
                'integer',
                'exists:projects,id',
            ],

            'name' => [
                'sometimes',
                'required',
                'string',
                'max:200',
            ],

            'slug' => [
                'sometimes',
                'nullable',
                'string',
                'max:255',
            ],

            'short_description' => [
                'sometimes',
                'nullable',
                'string',
                'max:500',
            ],

            'description' => [
                'sometimes',
                'nullable',
                'string',
            ],

            'target_amount' => [
                'sometimes',
                'required',
                'numeric',
                'min:0',
            ],

            'start_date' => [
                'sometimes',
                'required',
                'date',
            ],

            'end_date' => [
                'sometimes',
                'nullable',
                'date',
            ],

            'is_public' => [
                'sometimes',
                'boolean',
            ],

            'is_featured' => [
                'sometimes',
                'boolean',
            ],

            'status' => [
                'sometimes',
                'string',
                'in:draft,active,completed,paused,cancelled',
            ],
        ];
    }
}
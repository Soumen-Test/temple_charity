<?php

namespace App\Http\Requests\Api\V1\Donation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDonationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'donor_id' => [
                'sometimes',
                'nullable',
                'integer',
                'exists:donors,id',
            ],

            'is_anonymous' => [
                'sometimes',
                'boolean',
            ],

            'donor_note' => [
                'sometimes',
                'nullable',
                'string',
            ],
        ];
    }
}
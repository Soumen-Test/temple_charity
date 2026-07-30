<?php

namespace App\Http\Requests\Api\V1\Donor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDonorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:150',
            ],

            'mobile' => [
                'sometimes',
                'required',
                'string',
                'max:30',
            ],

            'email' => [
                'sometimes',
                'nullable',
                'email',
                'max:150',
            ],

            'address' => [
                'sometimes',
                'nullable',
                'string',
            ],

            'district' => [
                'sometimes',
                'nullable',
                'string',
                'max:100',
            ],

            'country' => [
                'sometimes',
                'nullable',
                'string',
                'max:100',
            ],

            'is_anonymous' => [
                'sometimes',
                'boolean',
            ],

            'user_id' => [
                'sometimes',
                'nullable',
                'integer',
                'exists:users,id',
            ],

            'is_active' => [
                'sometimes',
                'boolean',
            ],
        ];
    }
}
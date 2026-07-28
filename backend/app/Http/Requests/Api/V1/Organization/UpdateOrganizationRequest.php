<?php

namespace App\Http\Requests\Api\V1\Organization;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationRequest extends FormRequest
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
                'max:200',
            ],

            'short_name' => [
                'sometimes',
                'nullable',
                'string',
                'max:50',
            ],

            'registration_no' => [
                'sometimes',
                'nullable',
                'string',
                'max:100',
            ],

            'email' => [
                'sometimes',
                'nullable',
                'email',
                'max:150',
            ],

            'phone' => [
                'sometimes',
                'nullable',
                'string',
                'max:30',
            ],

            'website' => [
                'sometimes',
                'nullable',
                'url',
                'max:255',
            ],

            'address' => [
                'sometimes',
                'nullable',
                'string',
            ],

            'country' => [
                'sometimes',
                'nullable',
                'string',
                'max:100',
            ],

            'district' => [
                'sometimes',
                'nullable',
                'string',
                'max:100',
            ],

            'division' => [
                'sometimes',
                'nullable',
                'string',
                'max:100',
            ],

            'logo_path' => [
                'sometimes',
                'nullable',
                'string',
                'max:500',
            ],

            'is_active' => [
                'sometimes',
                'boolean',
            ],

            'remarks' => [
                'sometimes',
                'nullable',
                'string',
            ],
        ];
    }
}
<?php

namespace App\Http\Requests\Api\V1\Organization;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:200',
            ],

            'short_name' => [
                'nullable',
                'string',
                'max:50',
            ],

            'registration_no' => [
                'nullable',
                'string',
                'max:100',
            ],

            'email' => [
                'nullable',
                'email',
                'max:150',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'website' => [
                'nullable',
                'url',
                'max:255',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'country' => [
                'nullable',
                'string',
                'max:100',
            ],

            'district' => [
                'nullable',
                'string',
                'max:100',
            ],

            'division' => [
                'nullable',
                'string',
                'max:100',
            ],

            'logo_path' => [
                'nullable',
                'string',
                'max:500',
            ],

            'is_active' => [
                'sometimes',
                'boolean',
            ],

            'remarks' => [
                'nullable',
                'string',
            ],
        ];
    }
}
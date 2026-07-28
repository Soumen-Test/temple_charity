<?php

namespace App\Http\Requests\Api\V1\Temple;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTempleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'organization_id' => [
                'sometimes',
                'required',
                'integer',
                'exists:organizations,id',
            ],

            'name' => [
                'sometimes',
                'required',
                'string',
                'max:200',
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

            'division' => [
                'sometimes',
                'nullable',
                'string',
                'max:100',
            ],

            'priest_name' => [
                'sometimes',
                'nullable',
                'string',
                'max:150',
            ],

            'priest_mobile' => [
                'sometimes',
                'nullable',
                'string',
                'max:30',
            ],

            'latitude' => [
                'sometimes',
                'nullable',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'sometimes',
                'nullable',
                'numeric',
                'between:-180,180',
            ],

            'google_map_url' => [
                'sometimes',
                'nullable',
                'url',
                'max:500',
            ],

            'image_path' => [
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
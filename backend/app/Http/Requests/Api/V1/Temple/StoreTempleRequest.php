<?php

namespace App\Http\Requests\Api\V1\Temple;

use Illuminate\Foundation\Http\FormRequest;

class StoreTempleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'organization_id' => [
                'required',
                'integer',
                'exists:organizations,id',
            ],

            'name' => [
                'required',
                'string',
                'max:200',
            ],

            'address' => [
                'nullable',
                'string',
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

            'priest_name' => [
                'nullable',
                'string',
                'max:150',
            ],

            'priest_mobile' => [
                'nullable',
                'string',
                'max:30',
            ],

            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],

            'google_map_url' => [
                'nullable',
                'url',
                'max:500',
            ],

            'image_path' => [
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
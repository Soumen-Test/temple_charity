<?php

namespace App\Http\Requests\Api\V1\Donor;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonorRequest extends FormRequest
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
                'max:150',
            ],

            'mobile' => [
                'required',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:150',
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

            'country' => [
                'nullable',
                'string',
                'max:100',
            ],

            'is_anonymous' => [
                'sometimes',
                'boolean',
            ],

            'user_id' => [
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
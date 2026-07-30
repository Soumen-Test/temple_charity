<?php

namespace App\Http\Requests\Api\V1\File;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf,webp',
                'max:5120',
            ],

            'fileable_type' => [
                'nullable',
                'string',
                'max:100',
            ],

            'fileable_id' => [
                'nullable',
                'integer',
            ],

            'collection' => [
                'nullable',
                'string',
                'max:100',
            ],

            'is_public' => [
                'sometimes',
                'boolean',
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ];
    }
}
<?php

namespace App\Http\Requests\Api\V1\WebsiteContent;

use Illuminate\Foundation\Http\FormRequest;

class StoreWebsiteContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [

            'organization_id' => [
                'nullable',
                'integer',
                'exists:organizations,id',
            ],

            'temple_id' => [
                'nullable',
                'integer',
                'exists:temples,id',
            ],

            'content_key' => [
                'required',
                'string',
                'max:150',
            ],

            'content_type' => [
                'required',
                'string',
                'in:text,textarea,html,url,number,json',
            ],

            'content_value' => [
                'nullable',
                'string',
            ],

            'title' => [
                'nullable',
                'string',
                'max:200',
            ],

            'description' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'is_public' => [
                'nullable',
                'boolean',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ];
    }
}
<?php

namespace App\Http\Requests\Api\V1\Expense;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'organization_id' => [
                'required',
                'integer',
                'exists:organizations,id',
            ],

            'temple_id' => [
                'nullable',
                'integer',
                'exists:temples,id',
            ],

            'project_id' => [
                'nullable',
                'integer',
                'exists:projects,id',
            ],

            'campaign_id' => [
                'nullable',
                'integer',
                'exists:campaigns,id',
            ],

            'expense_date' => [
                'required',
                'date',
            ],

            'title' => [
                'required',
                'string',
                'max:200',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'expense_category' => [
                'required',
                'string',
                'max:100',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'currency' => [
                'nullable',
                'string',
                'size:3',
            ],

            'payment_method' => [
                'nullable',
                'string',
                'max:50',
            ],

            'reference_no' => [
                'nullable',
                'string',
                'max:100',
            ],
        ];
    }
}
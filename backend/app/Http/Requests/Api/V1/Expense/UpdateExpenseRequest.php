<?php

namespace App\Http\Requests\Api\V1\Expense;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'temple_id' => [
                'sometimes',
                'nullable',
                'integer',
                'exists:temples,id',
            ],

            'project_id' => [
                'sometimes',
                'nullable',
                'integer',
                'exists:projects,id',
            ],

            'campaign_id' => [
                'sometimes',
                'nullable',
                'integer',
                'exists:campaigns,id',
            ],

            'expense_date' => [
                'sometimes',
                'date',
            ],

            'title' => [
                'sometimes',
                'string',
                'max:200',
            ],

            'description' => [
                'sometimes',
                'nullable',
                'string',
            ],

            'expense_category' => [
                'sometimes',
                'string',
                'max:100',
            ],

            'amount' => [
                'sometimes',
                'numeric',
                'min:0.01',
            ],

            'currency' => [
                'sometimes',
                'string',
                'size:3',
            ],

            'payment_method' => [
                'sometimes',
                'nullable',
                'string',
                'max:50',
            ],

            'reference_no' => [
                'sometimes',
                'nullable',
                'string',
                'max:100',
            ],
        ];
    }
}
<?php

namespace App\Http\Requests\Api\V1\Project;

use App\Models\Temple;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateProjectRequest extends FormRequest
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

            'temple_id' => [
                'sometimes',
                'required',
                'integer',
                'exists:temples,id',
            ],

            'name' => [
                'sometimes',
                'required',
                'string',
                'max:200',
            ],

            'slug' => [
                'sometimes',
                'nullable',
                'string',
                'max:250',
            ],

            'short_description' => [
                'sometimes',
                'nullable',
                'string',
            ],

            'description' => [
                'sometimes',
                'nullable',
                'string',
            ],

            'project_type' => [
                'sometimes',
                'required',
                'string',
                'max:50',
            ],

            'start_date' => [
                'sometimes',
                'required',
                'date',
            ],

            'end_date' => [
                'sometimes',
                'nullable',
                'date',
            ],

            'target_amount' => [
                'sometimes',
                'nullable',
                'numeric',
                'min:0',
            ],

            'target_beneficiaries' => [
                'sometimes',
                'nullable',
                'numeric',
                'min:0',
            ],

            'cover_image_path' => [
                'sometimes',
                'nullable',
                'string',
                'max:500',
            ],

            'status' => [
                'sometimes',
                'in:draft,active,completed,paused,cancelled',
            ],

            'is_public' => [
                'sometimes',
                'boolean',
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

    public function after(): array
    {
        return [
            function (Validator $validator) {

                $organizationId = $this->input(
                    'organization_id',
                    $this->route('project')?->organization_id
                );

                $templeId = $this->input(
                    'temple_id',
                    $this->route('project')?->temple_id
                );

                if (!$organizationId || !$templeId) {
                    return;
                }

                $belongsToOrganization = Temple::query()
                    ->where('id', $templeId)
                    ->where(
                        'organization_id',
                        $organizationId
                    )
                    ->exists();

                if (!$belongsToOrganization) {
                    $validator->errors()->add(
                        'temple_id',
                        'The selected temple does not belong to the selected organization.'
                    );
                }
            },
        ];
    }
}
<?php

namespace App\Http\Requests\Admin\TrainingRecords;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->hasAnyRole([
            'admin',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'contact_name'       => ['nullable', 'string'],
            'contact_phone'      => ['nullable', 'string'],
            'parent_first_name'  => ['nullable', 'string'],
            'parent_middle_name' => ['nullable', 'string'],
            'parent_last_name'   => ['nullable', 'string'],
            'parent_sur_name'    => ['nullable', 'string'],
            'parent_kinship'     => ['nullable', 'string'],
            'parent_age'         => ['nullable', 'numeric'],
            'parent_id_number'   => ['nullable', 'string'],
            'parent_cui_number'  => ['nullable', 'string'],
            'parent_workplace'   => ['nullable', 'string'],
            'parent_phone'       => ['nullable', 'numeric'],
            'parent_email'       => ['nullable', 'string', 'email'],
            'can_read'           => ['required', 'boolean'],
            'study_sessions'     => ['required_if:can_read,1', 'nullable', 'string'],
            'study_schedule'     => ['required_if:can_read,1', 'nullable', 'string'],
            'workshop_id'        => ['required', 'numeric'],
            'person_id'          => ['required', 'numeric'],
        ];
    }
}

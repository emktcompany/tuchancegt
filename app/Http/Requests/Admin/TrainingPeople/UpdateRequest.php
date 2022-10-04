<?php

namespace App\Http\Requests\Admin\TrainingPeople;

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
            'first_name'         => ['required', 'string'],
            'middle_name'        => ['string', 'nullable'],
            'last_name'          => ['required', 'string'],
            'sur_name'           => ['string', 'nullable'],
            'place_of_birth'     => ['required', 'string'],
            'age'                => ['required', 'numeric'],
            'gender'             => ['required', 'string'],
            'ethnicity_id'       => ['required', 'numeric'],
            'id_number'          => ['required', 'string'],
            'cui_number'         => ['required', 'string'],
            'address'            => ['required', 'string'],
            'state_id'           => ['required', 'numeric'],
            'city_id'            => ['required', 'numeric'],
            'phone'              => ['required', 'string'],
            'phone_alt'          => ['string', 'nullable'],
            'email'              => ['required', 'string', 'email'],
            'language_community' => ['string', 'nullable'],
            'date_of_birth'      => ['required', 'string', 'date'],
        ];
    }
}

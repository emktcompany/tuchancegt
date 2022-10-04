<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchOpportunitiesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country'     => ['string', 'exists:countries,code'],
            'category_id' => ['numeric', 'exists:categories,id'],
            'bidder_id'   => ['numeric', 'exists:bidders,id'],
            'state_id'    => ['numeric', 'exists:states,id'],
            'city_id'     => ['numeric', 'exists:cities,id'],
            'term'        => ['string'],
        ];
    }
}

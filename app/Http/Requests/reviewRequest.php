<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class reviewRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'reviews' => "required",
//            'main_categories' => "required",
//            'sub_categories' => "required",
//            'description' => "required",
////            'estimated_budget' => "required|max:40",
////            'postalcode' => "required|max:255",
//            'when_need_it' => "required",
//            'when_need_it_date' => "required_if:when_need_it,3",
//            'purchase_type' => "required",
//            'description' => "required",
//            'state' => "required",
//            'city' => "required",
//            'lati' => "required",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }
    
    public function messages() {
        return [
//            'postalcode.required' => 'The where do you need it field is required.',
//            'when_need_it.required' => 'The when do you need it field is required.',
//            'purchase_type.required' => 'The what is this purchase For field is required.',
//            'lati.required' => 'Please enter a valid zipcode.',
        ];
    }

}
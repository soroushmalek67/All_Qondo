<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class supplierRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
       $rulesArray = [            
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'pnumber' => 'required',
            
//            'industries_you_buy' => 'required|max:300',
//            'industries_you_sell' => 'required|max:300',
            
            
           
        ];
        
        return $rulesArray;
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
<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Input;

class awardRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rulesArray = [         
            'awards' => 'required',   
            
//            'industries_you_buy' => 'required|max:300',
//            'industries_you_sell' => 'required|max:300',
//             'street_address' => 'required|max:300',
//             'city' => 'required|max:50',
//             'state' => 'required|max:50',
//             'postal_code' => 'required|max:20',
//             'country' => 'required|max:50',
            'awardImage' => "mimes:jpeg,jpg,bmp,png",
        ];
       
        return $rulesArray;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return [
            'awardImage.mimes' => 'Not a valid file type. Valid types include jpeg, jpg, bmp and png.'
        ];
    }

}
<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Input;

class UserRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rulesArray = [         
            'user_type' => 'required',   
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|email|max:255',
            'password' => 'confirmed|min:6',
            
            
//            'main_categories' => 'required',
//            'sub_categories' => 'required',
//            'service_states' => 'required',
//            'service_cities' => 'required',

//            'industries_you_buy' => 'required|max:300',
//            'industries_you_sell' => 'required|max:300',
//             'street_address' => 'required|max:300',
//             'city' => 'required|max:50',
//             'state' => 'required|max:50',
//             'postal_code' => 'required|max:20',
//             'country' => 'required|max:50',
            'company_logo_file' => "mimes:jpeg,jpg,bmp,png",
        ];
        
        if (empty(Input::get('userid'))) {
            $rulesArray = array_merge($rulesArray, ['email' => 'required|email|max:255|unique:users']);
        }
        if (FormRequest::get('user_type') == 1 || FormRequest::get('user_type') == 3) {
             $rulesArray = array_merge($rulesArray, ['building_id' => 'required']);
        }
        if (FormRequest::get('user_type') == 2 || FormRequest::get('user_type') == 3) {
            $rulesArray = array_merge($rulesArray, ['business_name' => 'required|max:200','main_categories' => 'required', 'sub_categories' => 'required','service_states' => 'required','service_cities' => 'required',]);
        }
        return $rulesArray;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return [
            
            'company_logo_file.mimes' => 'Not a valid file type. Valid types include jpeg, jpg, bmp and png.'
        ];
    }
     public function messages() {
         return[ 'building_id.required' => 'Building name is required',];
     }

}
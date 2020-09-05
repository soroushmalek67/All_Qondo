<?php
namespace App\Http\Requests\Users;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rulesArray = [            
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'password' => 'confirmed|min:6',
            
//            'industries_you_buy' => 'required|max:300',
//            'industries_you_sell' => 'required|max:300',
            
            'company_logo_file' => "mimes:jpeg,jpg,bmp,png",
            'company_banner_file' => "mimes:jpeg,jpg,bmp,png",
        ];
        if (Auth::userType() == 2) {
            $rulesArray = array_merge($rulesArray, ['business_name' => 'required|max:200',
                                                    'describe_product' => 'required',
                                                    'street_address' => 'required|max:300',
                                                    'city' => 'required|max:50',
                                                    'state' => 'required|max:50',
                                                    'postal_code' => 'required|max:20',
                                                    'country' => 'required|max:50',
                                                    'main_categories' => 'required',
                                                    'sub_categories' => 'required',
                                                    'service_states' => 'required',
                                                    'service_cities' => 'required',]);
        }
        if (Auth::userType() == 1) {
            $rulesArray = array_merge($rulesArray,['building_id' => 'required']);
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
            'company_logo_file.mimes' => 'Not a valid file type. Valid types include jpeg, jpg, bmp and png.',
            'company_banner_file.mimes' => 'Not a valid file type. Valid types include jpeg, jpg, bmp and png.'
        ];
    }
     public function messages() {
        return [
            'building_id.required' => 'Building field is required',
          
        ];
    }

}
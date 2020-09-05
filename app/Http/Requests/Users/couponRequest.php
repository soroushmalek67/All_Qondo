<?php
namespace App\Http\Requests\Users;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class couponRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rulesArray = [            
            'coupon_title' => 'required|max:100',
            'describe_coupon' => 'required|max:100',
            'coupon_star' => 'required|max:100',
            'coupon_discount' => 'required|max:100',
            
//            'industries_you_buy' => 'required|max:300',
//            'industries_you_sell' => 'required|max:300',
            
            'coupon_image_file' => "mimes:jpeg,jpg,bmp,png",
           
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
            'coupon_image_file.mimes' => 'Not a valid file type. Valid types include jpeg, jpg, bmp and png.',
            
        ];
    }

}
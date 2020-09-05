<?php
namespace App\Http\Requests\Users;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class productRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
       $rulesArray = [            
            'product_title' => 'required|max:100',
            'describe_product' => 'required',
            
//            'industries_you_buy' => 'required|max:300',
//            'industries_you_sell' => 'required|max:300',
            
            'product_image_file' => "mimes:jpeg,jpg,bmp,png",
           
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
            'product_image_file.mimes' => 'Not a valid file type. Valid types include jpeg, jpg, bmp and png.',
            
        ];
    }

}
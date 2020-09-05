<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'categoryName' => "required",
            'categoryImage' => "mimes:jpeg,jpg,bmp,png",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return [
            'categoryImage.required' => 'Pick a file to upload.',
            'categoryImage.mimes' => 'Not a valid file type. Valid types include jpeg, jpg, bmp and png.'
        ];
    }

}
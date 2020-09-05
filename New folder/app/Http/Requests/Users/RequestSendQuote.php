<?php
namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class RequestSendQuote extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'description' => 'required',
            'price' => 'required',
            'quoteFile' => 'mimes:jpeg,jpg,bmp,png,pdf,doc,docx',
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
            'quoteFile.mimes' => 'Not a valid file type. Valid types include jpeg, jpg, bmp, png, pdf, doc and docx.'
        ];
    }

}
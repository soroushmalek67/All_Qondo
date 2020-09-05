<?php
namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class RequestSendInvoice extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'request_id' => 'required',
            'amount' => 'required',
            'description' => 'required',
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
            'request_id.required' => 'Request is required',
            'amount.required' => 'Amount is required',
            'description.required' => 'Description is required',
        ];
    }

}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|unique:users|max:191',
            'email' => 'required|unique:users|max:191',
            'role_id' => 'required',
            'is_active' => 'required',
            'password' => 'required'
        ];
    }

    public function messages(){
        return [
            'role_id.required' => 'The role field is required.',
            // 'status.required' => 'The status field is required.'
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdatePasswordRequest extends Request
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
            'oldPassword' => 'required|max:45| old_password' . Auth::user()->password,
            'newPassword' => [
                'required',
                'min:6',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[A-Z]).+$/',
                'confirmed'
            ],
            'repPassword' => 'required|max:45|same:newPassword',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SaveTaskFileRequest extends Request
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
            'file' => 'required|max:15000|mimes:png,jpg,jpeg,zip,rar,pdf,tex,docx,xlsx,tar,bz2,7z'
        ];
    }
}

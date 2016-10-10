<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateGroupRequest extends Request
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
           'nama_group' => 'required',
           'finger_group_id' => 'required',       
        ];
    }

    public function messages()
    {
        return [
            'nama_group.required' => 'Nama Unit harus diisi',
            // 'nama_group.unique' => 'Nama Unit sudah ada',
            'finger_group_id.required' => 'Finger ID harus diisi',
            // 'finger_group_id.unique' => 'Finger ID sudah ada',
        ];
    }
}

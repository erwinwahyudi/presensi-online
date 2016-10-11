<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreAnggotaRequest extends Request
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

                    'finger_id'   =>  'required|unique:users',
                    'nama'        =>  'required',
                    // 'nip'         =>  'required',
                    // 'jabatan'     =>  'required',
                    // 'golongan'    =>  'required',
                    'email'       =>  'required|email',
                    'username'    =>  'required|unique:users',
                    'password'    =>  'required|min:6',
        ];
    }

    public function messages() {
        return [
                    'finger_id.required'   =>  'Finger ID tidak boleh kosong',
                    'finger_id.unique' => 'Finger ID sudah ada',
                    'nama.required'        =>  'Nama tidak boleh kosong',
                    // 'nip.required'         =>  'NIP tidak boleh kosong',
                    // 'jabatan.required'     =>  'Jabatan tidak boleh kosong',
                    // 'golongan.required'    =>  'Golongan tidak boleh kosong',
                    'email.required'       =>  'Email tidak boleh kosong',
                    'username.required'    =>  'Username tidak boleh kosong',
                    'username.unique'      =>   'Username sudah ada',
                    'password.required'    =>  'Password tidak boleh kosong',
                    'password.min'         =>   'Password minimal 6',
                ];
    }
}

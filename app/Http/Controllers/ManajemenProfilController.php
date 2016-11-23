<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;

class ManajemenProfilController extends Controller
{
    public function index()
    {
    	return view('adminpanel.manajemen_profil.password');
    }

    public function edit_pass(Request $request)
    {
    	// print_r($request->all());
    	$this->validate($request, [
    				// 'password_lama'			=> 'required',
    				'password_baru' 		=> 'required|min:6',
    				'konfirmasi_password'	=> 'required|same:password_baru',
	    		],[
	    			// 'password_lama.required' 		=> 'Password lama harus diisi' ,
	    			'password_baru.required' 		=> 'Password baru harus diisi' ,
	    			'password_baru.min'				=> 'Password minimal 6 karakter',
	    			'konfirmasi_password.required' 	=> 'Password konfirmasi harus diisi' ,
	    			'konfirmasi_password.same' 		=> 'Password konfirmasi tidak sama dengan password baru',
	    		]);

    	// $request->flash('password-lama');
    	// $password_lama			= $request->password_lama;
    	$userid					= Auth::user()->id;
    	$groupid				= Auth::user()->group_id;
    	$password_baru 			= $request->password_baru;
    	$konfirmasi_password 	= $request->konfirmasi_password;

    	$update 	= 	User::where('id', $userid)->where('group_id', $groupid)->update([
    							'password'	=> bcrypt($password_baru),
    					]);

    	if( $update ) {
				return redirect('/ubah-pass')
						  ->with('status_error', 'success')
						  ->with('pesan_error', 'Password berhasil diubah.');
		} else {
				return redirect()->back()
						  ->with('status_error', 'danger')
						  ->with('pesan_error', 'Password gagal diubah');
		}    	
    }
}

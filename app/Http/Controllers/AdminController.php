<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Auth;

use App\User;
use App\Group;

class AdminController extends Controller
{
    public function index()
    {
    	$data['users']	=  User::where('level', '!=', 'anggota')->where('level', '!=', 'superadmin')->get();
    	$data['groups'] =  Group::all();
    	// echo "<pre>";
    	// print_r($data);
    	// echo "</pre>";
    	return view('adminpanel.manajemen_admin.index', compact('data'));
    }

    public function create(Request $request)
    {
    	// echo "<pre>";
    	// print_r($request->all());
    	// echo "</pre>";

    	$this->validate($request, [
    		'nama'					=> 'required',
    		'username'				=> 'required',
    		'password'				=> 'required|min:6',
    		'konfirmasi_password'	=> 'required|same:password',
    	],[
    		'nama.required'					=> 'Nama tidak boleh kosong',
    		'username.required'				=> 'Username tidak boleh kosong',
    		'password.required'				=> 'Password tidak boleh kosong',
    		'password.min'					=> 'Password harus lebih dari 6 karakter',
    		'konfirmasi_password.required'	=> 'Konfirmasi tidak boleh kosong',
    		'konfirmasi_password.same'		=> 'Password konfirmasi tidak sama',
    	]);

    	$nama 			=  $request->nama;
    	$username 		=  $request->username;
    	$password 		=  $request->password;
    	$level			=  $request->level;
    	$group_id		=  $request->group_id;

    	if($level == 'superadmin') {
    		$group_id  = '0';
    	}

    	$save = User::create([    		
						  'username'    =>  $username,						  				  						  
						  'nama'        =>  $nama,	
						  'password'    =>  bcrypt($password),
						  'level'       =>  $level,			
						  'group_id'    =>  $group_id,				  
						  'kelompok_id' =>  '0',
						  'finger_id'   =>  '0',
						  'nip'         =>  '-',
						  'jabatan'     =>  '-',
						  'golongan'    =>  '-',
						  ]);

    	if( $save ) {
				return redirect('/tambah-admin')
						  ->with('status_error', 'success')
						  ->with('pesan_error', 'Data berhasil ditambah.');
		} else {
				return redirect()->back()
						  ->with('status_error', 'danger')
						  ->with('pesan_error', 'Data gagal ditambah');
		}    	
    }

    public function delete($id)
    {
    	$user 	=  User::findOrFail($id);
    	$user->delete();

    	return redirect('/tambah-admin')
						  ->with('status_error', 'success')
						  ->with('pesan_error', 'Data berhasil dihapus.');
    }
}

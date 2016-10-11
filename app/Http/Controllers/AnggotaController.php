<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StoreAnggotaRequest;

// deklarasi model Anggota
use App\User;
use App\Group;
use App\Kelompok;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $anggotas = Anggota::all();
        // return view('adminpanel.anggota.daftar', compact('anggotas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($uid)
    {
        $unit_id = $uid;
        $group = Group::findOrFail($uid);
        $kelompoks = Kelompok::where('group_id', $uid)->get();
        return view('adminpanel.anggota.create', compact('unit_id', 'group', 'kelompoks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnggotaRequest $request)
    {
        $level       =  $request->input('level');
        $group_id    =  $request->input('group_id');
        $finger_id   =  $request->input('finger_id');
        $nama        =  $request->input('nama');
        $nip         =  $request->input('nip');
        $jabatan     =  $request->input('jabatan');
        $golongan    =  $request->input('golongan');
        $kelompok_id =  $request->input('kelompok_id');
        $email       =  $request->input('email');
        $username    =  $request->input('username');
        $password    =  $request->input('password');

        $save = User::create([
                    'level'       =>  $level,
                    'group_id'    =>  $group_id,
                    'finger_id'   =>  $finger_id,
                    'nama'        =>  $nama,
                    'nip'         =>  $nip,
                    'jabatan'     =>  $jabatan,
                    'golongan'    =>  $golongan,
                    'kelompok_id' =>  $kelompok_id,
                    'email'       =>  $email,
                    'username'    =>  $username,
                    'password'    =>  bcrypt($password)
                    ]);
        if ( $save ) {
            return redirect('/unit/'.$group_id)
                    ->with('status_error', 'info')
                    ->with('pesan_error', 'Data berhasil ditambah.');
        } else {
            return redirect()->back()
                    ->with('status_error', 'danger')
                    ->with('pesan_error', 'Data gagal disimpan, terjadi kesalahan');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uid, $id)
    {
        $anggota = User::findOrFail($id);
        $kelompoks = Kelompok::where('group_id', $uid)->get();
        return view('adminpanel.anggota.update', compact('anggota', 'kelompoks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uid, $id)
    {
        $level       =  $request->input('level');
        $group_id    =  $request->input('group_id');
        $finger_id   =  $request->input('finger_id');
        $nama        =  $request->input('nama');
        $nip         =  $request->input('nip');
        $jabatan     =  $request->input('jabatan');
        $golongan    =  $request->input('golongan');
        $kelompok_id =  $request->input('kelompok_id');
        $email       =  $request->input('email');
        $username    =  $request->input('username');
        $password    =  $request->input('password');

        $update = User::where('id', $id)->update([
                    'level'       =>  $level,
                    'group_id'    =>  $group_id,
                    'finger_id'   =>  $finger_id,
                    'nama'        =>  $nama,
                    'nip'         =>  $nip,
                    'jabatan'     =>  $jabatan,
                    'golongan'    =>  $golongan,
                    'kelompok_id' =>  $kelompok_id,
                    'email'       =>  $email,
                    'username'    =>  $username,
                    ]);

        if($password!==''){
            User::where('id', $id)->update([ 'password' => bcrypt($password) ]);
        }
        
        if ( $update ) {
            return redirect('/unit/'.$group_id)
                    ->with('status_error', 'info')
                    ->with('pesan_error', 'Data berhasil ditambah.');
        } else {
            return redirect()->back()
                    ->with('status_error', 'danger')
                    ->with('pesan_error', 'Data gagal disimpan, terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uid, $id)
    {
        $user = User::findOrFail($id);

        $user->delete();
        return redirect()->back()
                    ->with('status_error', 'info')
                    ->with('pesan_error', 'Data terhapus');
    }
}

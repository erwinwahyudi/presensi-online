<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use DB;

// ambil model
use App\User;
use App\Izin;

class IzinController extends Controller
{
    public function index()
    {
        if( Auth::user()->level == 'admin' ) {
            $groupid    =  Auth::user()->group_id;
            $users      =  User::where('group_id', $groupid)->get();  
        } else {
            $users      =  Auth::user()->id;
        }

        $kat_izins      =  DB::table('kategori_izin')->get();
        return view( 'adminpanel.izin.index', compact('users', 'kat_izins') );
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'tgl_mulai_izin'    => 'required',
            'tgl_selesai_izin'  => 'required',
            'file_surat'        => 'required',
        ], [
            'tgl_mulai_izin.required'   => 'tgl harus di isi.',
            'tgl_selesai_izin.required' => 'tgl harus di isi.',
            'file_surat.required'       => 'file surat tidak boleh kosong.',
        ]);

        $userid             = $request->users_id;
        $groupid            = $request->group_id;
        $tgl_mulai_izin     = $request->tgl_mulai_izin;
        $tgl_selesai_izin   = $request->tgl_selesai_izin;
        $kode_izin          = $request->kode_izin;
        $file               = $request->file('file_surat');

        if($request->hasFile('file_surat')) {
            $real_name  =  $file->getClientOriginalName();
            $extfile    =  $file->getClientOriginalExtension();
            $filename   =  md5(time().rand()).".".$extfile;
            $lokasi     =  public_path().'/file_surat';

            //pindah file
            $file->move($lokasi, $filename);
        }

        $save   =  Izin::create([
                                    'users_id'          => $userid,
                                    'group_id'          => $groupid,
                                    'tgl_mulai_izin'    => $tgl_mulai_izin,
                                    'tgl_selesai_izin'  => $tgl_selesai_izin,
                                    'kode_izin'         => $kode_izin,
                                    'file_surat'        => $filename,
                                ]);

        if ( $save ) {
            return redirect('/izin')
                    ->with('status_error', 'success')
                    ->with('pesan_error', 'Data berhasil ditambah.');
        } else {
            return redirect()->back()
                    ->with('status_error', 'danger')
                    ->with('pesan_error', 'Data gagal disimpan, terjadi kesalahan');
        }
    }
}

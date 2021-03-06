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
            // 'tgl_mulai_izin'    => 'required',
            'tglrentang'        => 'required',
            'dinas'             => 'required',
            'file_surat'        => 'required',
            'tglrentang'        => 'required',
        ], [
            // 'tgl_mulai_izin.required'   => 'tgl harus di isi.',
            'tglrentang.required'       => 'tgl harus di isi.',
            'dinas.required'            => 'Pilih kategori dinas',
            'file_surat.required'       => 'file surat tidak boleh kosong.',
            'tglrentang.required'       => 'Tanggal rentang harus diisi.',

        ]);

        // echo "<pre>";
        // print_r($request->all()); die();
        // echo "</pre>"; die();

        $userid             = $request->users_id;
        $groupid            = $request->group_id;        
        $dinas              = $request->dinas;
        $tglrentang         = $request->tglrentang;

        $exp_tglrentang     = explode("-", $tglrentang);
        $tgl_mulai_izin     = str_replace( "/", "-", $exp_tglrentang[0] );
        $tgl_selesai_izin   = str_replace( "/", "-", $exp_tglrentang[1] );

        //jia dinas
        if($dinas == '1') {
            $kode_izin      = '';
            $keterangan     = $request->keterangan;
        } else {
            $kode_izin      = $request->kode_izin;
            $keterangan     = $request->keterangan_izin;
        }

        $file               = $request->file('file_surat');
        //cek apakah di rentang tgl, sudah ada data
        $cek_tgl    = DB::table('izin')->whereBetween('tgl_mulai_izin', [$tgl_mulai_izin, $tgl_selesai_izin])
                                       ->where('users_id', $userid)
                                       ->where('group_id', $groupid)->count();
        if( $cek_tgl > 0 ) {
            return redirect('/izin')
                        ->with('status_error', 'danger')
                        ->with('pesan_error', 'Duplikat entri tanggal');
        } else {
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
                                        'dinas'             => $dinas,
                                        'kode_izin'         => $kode_izin,
                                        'keterangan'        => $keterangan,
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

    public function log()
    {
        if( Auth::user()->level == 'admin' ) {
            $groupid    = Auth::user()->group_id;
            $izins      = Izin::join('users', 'users.id', '=' , 'izin.users_id')
                                    ->where('izin.group_id', $groupid)->get();
        } else {
            $userid     = Auth::user()->id;
            $izins      = Izin::where('users_id', $userid)->get();
        }
        
        return view('adminpanel.izin.log_izin', compact('izins'));
    }

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

// panggil model
use App\Kelompok;
use App\Group;

class KelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        return view('adminpanel.kelompok.create', compact('unit_id', 'group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $uid)
    {
        // echo "<pre>";
        // print_r( $request->all() );
        // echo "</pre>";
        // die();

        // ambil semua post
        $group_id                        =  $request->group_id;  
        $nama_kelompok                   =  $request->nama_kelompok;  
        $absen_istirahat                 =  $request->absen_istirahat;  
        $absen_masuk_istirahat           =  $request->absen_masuk_istirahat;  
        $absen_pulang                    =  $request->absen_pulang;  
        $hitung_lembur                   =  $request->hitung_lembur;  
        $awal_masuk                      =  $request->awal_masuk;  
        $akhir_masuk                     =  $request->akhir_masuk;  
        $awal_masuk_jumat                =  $request->awal_masuk_jumat;  
        $akhir_masuk_jumat               =  $request->akhir_masuk_jumat;  
        $awal_istirahat                  =  $request->awal_istirahat;  
        $akhir_istirahat                 =  $request->akhir_istirahat;  
        $awal_istirahat_jumat            =  $request->awal_istirahat_jumat;  
        $akhir_istirahat_jumat           =  $request->akhir_istirahat_jumat;  
        $awal_masuk_istirahat            =  $request->awal_masuk_istirahat;  
        $akhir_masuk_istirahat           =  $request->akhir_masuk_istirahat;  
        $awal_masuk_istirahat_jumat     =  $request->awal_masuk_istirahat_jumat;  
        $akhir_masuk_istirahat_jumat    =  $request->akhir_masuk_istirahat_jumat;  
        $awal_pulang                     =  $request->awal_pulang;  
        $akhir_pulang                    =  $request->akhir_pulang;  
        $awal_pulang_jumat               =  $request->awal_pulang_jumat;  
        $akhir_pulang_jumat              =  $request->akhir_pulang_jumat;  
        $nama_penandatangan1             =  $request->nama_penandatangan1;  
        $nip_penandatangan1              =  $request->nip_penandatangan1;  
        $jabatan_penandatangan1          =  $request->jabatan_penandatangan1;  
        $nama_penandatangan2             =  $request->nama_penandatangan2;  
        $nip_penandatangan2              =  $request->nip_penandatangan2;  
        $jabatan_penandatangan2          =  $request->jabatan_penandatangan2;  

        //cek apakah ada inputan checkbox
        $request->has('absen_masuk') ? $absen_masuk = '1' : $absen_masuk = '0';
        $request->has('absen_masuk_istirahat') ? $absen_masuk_istirahat = '1' : $absen_masuk_istirahat = '0';
        $request->has('absen_istirahat') ? $absen_istirahat = '1' : $absen_istirahat = '0';
        $request->has('absen_pulang') ? $absen_pulang = '1' : $absen_pulang = '0';  

        // echo $nama_kelompok; die();

        $save = Kelompok::create([
                    'group_id'                        =>  $group_id,  
                    'nama_kelompok'                   =>  $nama_kelompok,  
                    'absen_istirahat'                 =>  $absen_istirahat,  
                    'absen_masuk_istirahat'           =>  $absen_masuk_istirahat,  
                    'absen_pulang'                    =>  $absen_pulang,  
                    'hitung_lembur'                   =>  $hitung_lembur,  
                    'awal_masuk'                      =>  $awal_masuk,  
                    'akhir_masuk'                     =>  $akhir_masuk,  
                    'awal_masuk_jumat'                =>  $awal_masuk_jumat,  
                    'akhir_masuk_jumat'               =>  $akhir_masuk_jumat,  
                    'awal_istirahat'                  =>  $awal_istirahat,  
                    'akhir_istirahat'                 =>  $akhir_istirahat,  
                    'awal_istirahat_jumat'            =>  $awal_istirahat_jumat,  
                    'akhir_istirahat_jumat'           =>  $akhir_istirahat_jumat,  
                    'awal_masuk_istirahat'            =>  $awal_masuk_istirahat,  
                    'akhir_masuk_istirahat'           =>  $akhir_masuk_istirahat,  
                    'awal_masuk_istirahat_jumat'     =>  $awal_masuk_istirahat_jumat,  
                    'akhir_masuk_istirahat_jumat'    =>  $akhir_masuk_istirahat_jumat,  
                    'awal_pulang'                     =>  $awal_pulang,  
                    'akhir_pulang'                    =>  $akhir_pulang,  
                    'awal_pulang_jumat'               =>  $awal_pulang_jumat,  
                    'akhir_pulang_jumat'              =>  $akhir_pulang_jumat,  
                    'nama_penandatangan1'             =>  $nama_penandatangan1,  
                    'nip_penandatangan1'              =>  $nip_penandatangan1,  
                    'jabatan_penandatangan1'          =>  $jabatan_penandatangan1,  
                    'nama_penandatangan2'             =>  $nama_penandatangan2,  
                    'nip_penandatangan2'              =>  $nip_penandatangan2,  
                    'jabatan_penandatangan2'          =>  $jabatan_penandatangan2,  
                ]);

        if( $save ) {
            return redirect('/unit/'.$group_id)
                    ->with('status_error', 'success')
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
        $kelompok = Kelompok::findOrFail($id);

        return view('adminpanel.kelompok.update', compact('kelompok'));
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
        // echo "<pre>";
        // print_r($request->all());
        // echo "</pre>";

        // echo "<pre>";
        // print_r( $request->all() );
        // echo "</pre>";
        // die();

        // ambil semua post
        $group_id                        =  $request->group_id;  
        $nama_kelompok                   =  $request->nama_kelompok;  
        $absen_istirahat                 =  $request->absen_istirahat;  
        $absen_masuk_istirahat           =  $request->absen_masuk_istirahat;  
        $absen_pulang                    =  $request->absen_pulang;  
        $hitung_lembur                   =  $request->hitung_lembur;  
        $awal_masuk                      =  $request->awal_masuk;  
        $akhir_masuk                     =  $request->akhir_masuk;  
        $awal_masuk_jumat                =  $request->awal_masuk_jumat;  
        $akhir_masuk_jumat               =  $request->akhir_masuk_jumat;  
        $awal_istirahat                  =  $request->awal_istirahat;  
        $akhir_istirahat                 =  $request->akhir_istirahat;  
        $awal_istirahat_jumat            =  $request->awal_istirahat_jumat;  
        $akhir_istirahat_jumat           =  $request->akhir_istirahat_jumat;  
        $awal_masuk_istirahat            =  $request->awal_masuk_istirahat;  
        $akhir_masuk_istirahat           =  $request->akhir_masuk_istirahat;  
        $awal_masuk_istirahat_jumat     =  $request->awal_masuk_istirahat_jumat;  
        $akhir_masuk_istirahat_jumat    =  $request->akhir_masuk_istirahat_jumat;  
        $awal_pulang                     =  $request->awal_pulang;  
        $akhir_pulang                    =  $request->akhir_pulang;  
        $awal_pulang_jumat               =  $request->awal_pulang_jumat;  
        $akhir_pulang_jumat              =  $request->akhir_pulang_jumat;  
        $nama_penandatangan1             =  $request->nama_penandatangan1;  
        $nip_penandatangan1              =  $request->nip_penandatangan1;  
        $jabatan_penandatangan1          =  $request->jabatan_penandatangan1;  
        $nama_penandatangan2             =  $request->nama_penandatangan2;  
        $nip_penandatangan2              =  $request->nip_penandatangan2;  
        $jabatan_penandatangan2          =  $request->jabatan_penandatangan2;  

        //cek apakah ada inputan checkbox
        $request->has('absen_masuk_istirahat') ? $absen_masuk_istirahat = '1' : $absen_masuk_istirahat = '0';
        $request->has('absen_istirahat') ? $absen_istirahat = '1' : $absen_istirahat = '0';
        $request->has('absen_pulang') ? $absen_pulang = '1' : $absen_pulang = '0';  

        // echo $nama_kelompok; die();

        $update = Kelompok::where('id', $id)->update([
                    'group_id'                        =>  $group_id,  
                    'nama_kelompok'                   =>  $nama_kelompok,  
                    'absen_istirahat'                 =>  $absen_istirahat,  
                    'absen_masuk_istirahat'           =>  $absen_masuk_istirahat,  
                    'absen_pulang'                    =>  $absen_pulang,  
                    'hitung_lembur'                   =>  $hitung_lembur,  
                    'awal_masuk'                      =>  $awal_masuk,  
                    'akhir_masuk'                     =>  $akhir_masuk,  
                    'awal_masuk_jumat'                =>  $awal_masuk_jumat,  
                    'akhir_masuk_jumat'               =>  $akhir_masuk_jumat,  
                    'awal_istirahat'                  =>  $awal_istirahat,  
                    'akhir_istirahat'                 =>  $akhir_istirahat,  
                    'awal_istirahat_jumat'            =>  $awal_istirahat_jumat,  
                    'akhir_istirahat_jumat'           =>  $akhir_istirahat_jumat,  
                    'awal_masuk_istirahat'            =>  $awal_masuk_istirahat,  
                    'akhir_masuk_istirahat'           =>  $akhir_masuk_istirahat,  
                    'awal_masuk_istirahat_jumat'     =>  $awal_masuk_istirahat_jumat,  
                    'akhir_masuk_istirahat_jumat'    =>  $akhir_masuk_istirahat_jumat,  
                    'awal_pulang'                     =>  $awal_pulang,  
                    'akhir_pulang'                    =>  $akhir_pulang,  
                    'awal_pulang_jumat'               =>  $awal_pulang_jumat,  
                    'akhir_pulang_jumat'              =>  $akhir_pulang_jumat,  
                    'nama_penandatangan1'             =>  $nama_penandatangan1,  
                    'nip_penandatangan1'              =>  $nip_penandatangan1,  
                    'jabatan_penandatangan1'          =>  $jabatan_penandatangan1,  
                    'nama_penandatangan2'             =>  $nama_penandatangan2,  
                    'nip_penandatangan2'              =>  $nip_penandatangan2,  
                    'jabatan_penandatangan2'          =>  $jabatan_penandatangan2,  
                ]);

        if( $update ) {
            return redirect('/unit/'.$group_id)
                    ->with('status_error', 'success')
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
        $kelompok  = Kelompok::findOrFail($id);
        $kelompok->delete();

        return redirect()->back()
                    ->with('status_error', 'success')
                    ->with('pesan_error', 'Data berhasil dihapus');
    }
}

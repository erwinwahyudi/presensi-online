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

        $group_id                        =  $request->group_id;  
        $nama_kelompok                   =  $request->nama_kelompok;  
        $absen_masuk                     =  $request->absen_masuk;  
        $absen_istirahat                 =  $request->absen_istirahat;  
        $absesn_masuk_istirahat          =  $request->absesn_masuk_istirahat;  
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
        $awal_masuk_istrirahat_jumat     =  $request->awal_masuk_istrirahat_jumat;  
        $akhir_masuk_istrirahat_jumat    =  $request->akhir_masuk_istrirahat_jumat;  
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

       
        $post = $request->all();

        $post->save($post);

        return redirect()->back();
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

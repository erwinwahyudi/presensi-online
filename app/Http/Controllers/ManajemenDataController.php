<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use Storage;

// ambil model
use App\Filelog;
use App\Attlog;


class ManajemenDataController extends Controller
{
    

    public function index()
    {
        return view('adminpanel.manajemen_data.index');
    }


    public function uploadfile(Request $request)
    {
        
        $bulantahun = $request->bulantahun;
        $file       = $request->file('attlogfile');
        $userid     = Auth::user()->id;
        $groupid    = Auth::user()->group_id;        
        
        // cek apakah ada file yg di upload
        if(!$request->hasFile('attlogfile')) {
            return "tidak ada file";
        }

        $real_name  = $file->getClientOriginalName();
        $filename   = md5(time().rand()).".".$file->getClientOriginalExtension();
        $lokasi     = public_path().'/attlogfile';
        $realpath   = $file->getPathName();

        // pindah filenya
        $file->move($lokasi, $filename);

        // query ke db FIlelog untuk simpan filenya
        $save   =   Filelog::create([
                                    'user_id'       =>  $userid,
                                    'group_id'      =>  $groupid,
                                    'bulan_tahun'   =>  $bulantahun,
                                    'real_name'     =>  $real_name,
                                    'filename'      =>  $filename
                                ]);

        // baca filenya dari folder berdasarkan data yg di upload
         // $getfile = file_get_contents(getcwd(). $realpath."/".$real_name);
         $getfile = file_get_contents(getcwd(). "/attlogfile/".$filename);
         $arrays = explode("\r\n", $getfile);

        // pisahkan data bulandtahun dari post
        $expbulantahun = explode("/", $bulantahun);
            $expbulantahun_bulan    = $expbulantahun[0];
            $expbulantahun_tahun    = $expbulantahun[1];

                
        // perulangan untuk baca file
         foreach ($arrays as $arr) {
            $arrexp         = explode("\t", trim($arr));
            // user id
            $userid    = $arrexp[0];
            //datetime
            $datetime   = $arrexp[1];
                $explspasi      = explode(" ", $datetime);
            // tanggal
            $date = $explspasi[0];
            // waktu
            $time = $explspasi[1];

            //group_id
            $groupid   = $arrexp[2];


            //pisahkan bulan, tgl dan tahun dari date attlog
            $expdate         = explode("-", $date);
                $expdate_tahun   = $expdate[0];
                $expdate_bulan   = $expdate[1];

            //cek dari file attlog apakah sama dg bulan yg d post, jika sama maka insert ke db
            if($expdate_bulan==$expbulantahun_bulan && $expdate_tahun==$expbulantahun_tahun) {
                Attlog::create([
                            'datetime'  =>  $datetime,
                            'date'      =>  $date,
                            'time'      =>  $time,
                            'user_id'   =>  $userid,
                            'group_id'  =>  $groupid
                        ]);
                echo $userid." | ";
                echo $date." | ";
                echo $time." | ";
                echo $groupid;             
                echo "<br>";
            } else {
                //delete file yg sebelumnya disimpan jika tidak ada kondisi cocok
                Storage::delete("/attlogfile/".$filename);
            }
         }


        // if ( $save ) {
            return redirect('/manajemen-data')
                    ->with('status_error', 'info')
                    ->with('pesan_error', 'Data berhasil diupload.');
        // } else {
        //     return redirect()->back()
        //             ->with('status_error', 'danger')
        //             ->with('pesan_error', 'Data gagal upload, terjadi kesalahan');
        // }
    }
 

    public function logupload() {
        $filelogs = Filelog::all();

        return view('adminpanel.manajemen_data.logfile', compact('filelogs'));
    }

    public function hitungdata() {
        return view('adminpanel.manajemen_data.hitung');
    }
}

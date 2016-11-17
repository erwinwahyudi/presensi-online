<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', '1000');

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use Storage;
use Carbon;

// ambil model
use App\Filelog;
use App\Attlog;
use App\Fn;
use App\Hitung;


class ManajemenDataController extends Controller
{

	 public function index()
	 {
		  return view('adminpanel.manajemen_data.index');
	 }


	 public function uploadfile(Request $request)
	 {

		 $this->validate($request, [
					'bulantahun'           => 'required',
					'attlogfile'           => 'required',
		 ], [
					'bulantahun.required'  => 'Bulan dan Tahun tidak boleh kosong',
					'attlogfile.required'  => 'File belum ditambahkan'
		 ]);

		  $bulantahun = $request->bulantahun;
		  $file       = $request->file('attlogfile');
		  $userid     = Auth::user()->id;
		  $groupid    = Auth::user()->group_id;

		  //cek apakah dibulan tersebut sudah pernah input data atau belum
		  $cek_attlog  = Filelog::where('bulan_tahun', $bulantahun)->where('user_id', $userid)->where('group_id', $groupid)->count();

		  if( $cek_attlog = 0 )
		  {
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
					  $fn_bt = Fn::pisah_bulantahun($bulantahun);
							$bulan    = $fn_bt['bulan'];
							$tahun    = $fn_bt['tahun'];


					  // perulangan untuk baca file
					  foreach ($arrays as $arr) {
							$arrexp         = explode("\t", trim($arr));
							// user id
							$finger_id    = $arrexp[0];
							//datetime
							$datetime   = $arrexp[1];
								 $explspasi      = explode(" ", $datetime);
							// tanggal
							$date = $explspasi[0];
							// waktu
							$time = $explspasi[1];

							//finger_group_id
							$finger_group_id   = $arrexp[2];


							//pisahkan bulan, tgl dan tahun dari date attlog
							$expdate         = explode("-", $date);
								 $expdate_tahun   = $expdate[0];
								 $expdate_bulan   = $expdate[1];

							//cek dari file attlog apakah sama dg bulan yg d post, jika sama maka insert ke db
							if($expdate_bulan==$bulan && $expdate_tahun==$tahun) {
								 Attlog::create([
												 'datetime'  =>  $datetime,
												 'date'      =>  $date,
												 'time'      =>  $time,
												 'finger_id' =>  $finger_id,
												 'finger_group_id'  =>  $finger_group_id
											]);
								 echo $finger_id." | ";
								 echo $date." | ";
								 echo $time." | ";
								 echo $finger_group_id;
								 echo "<br>";
							} else {
								 //delete file yg sebelumnya disimpan jika tidak ada kondisi cocok
								 Storage::delete("/attlogfile/".$filename);
							}
						}


					  if ( $save ) {
							return redirect('/manajemen-data')
									  ->with('status_error', 'success')
									  ->with('pesan_error', 'Data berhasil diupload.');
					  } else {
							return redirect()->back()
									  ->with('status_error', 'danger')
									  ->with('pesan_error', 'Data gagal upload, terjadi kesalahan');
					  }
			} else {
					return redirect()->back()
									->with('status_error', 'danger')
									->with('pesan_error', 'Bulan dan Tahun tersebut sudah ada');
			}
	 }


	 public function logupload()
	 {
		  $filelogs = Filelog::all();

		  return view('adminpanel.manajemen_data.logfile', compact('filelogs'));
	 }

	 public function indexhitung()
	 {
		  return view('adminpanel.manajemen_data.hitung');
	 }

	 public function hitung(Request $request)
	 {

			echo "<pre>";
			print_r($request->all());
			echo "</pre>"; die();

		  $groupid    = Auth::user()->group_id;
		  $tglrentang = $request->tglrentang;

		  //pisah rentang tanggal
		  $exp_tglrentang     = explode("-", $tglrentang);
		  $dari_tgl           = str_replace( "/", "-", $exp_tglrentang[0] );
		  $sampai_tgl         = str_replace( "/", "-", $exp_tglrentang[1] );


		  echo "<pre>";
		  $hitung = Hitung::hitung_unit_kerja($groupid, $dari_tgl, $sampai_tgl);
		  print_r($hitung);
		  echo "</pre>";

		  return redirect()->back()
						  ->with('status_error', 'success')
						  ->with('pesan_error', 'Perhitungan selesai.');
	 }
}

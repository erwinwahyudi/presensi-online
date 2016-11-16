<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Fn;
use App\Libur;

class LiburController extends Controller
{
		public function index()
		{
			$data['libur']     = Libur::orderBy('tanggal', 'asc')->get();
			foreach ($data['libur'] as $key => $value) {
					$data['libur'][$key]->tgl = Fn::date_to_string($value->tanggal);
			}

			// echo "<pre>";
			// print_r($data);
			// echo "</pre>";
			return view('adminpanel.libur.index', compact('data'));
		}

		public function create(Request $request)
		{
				$this->validate($request, [
								'tgl_libur'   => 'required',
								'keterangan'  => 'required',
				],[
								'tgl_libur.required'  => 'Tanggal tidak boleh kosong',
								'keterangan.required' => 'Keterangan tidak boleh kosong',
				]);

				$tanggal      =  $request->tgl_libur;
				$keterangan   =  $request->keterangan;
				$nama_bulan   =  Fn::tgl_to_bulan($tanggal);

				$save         =  Libur::create([
															'tanggal'    => $tanggal,
															'keterangan' => $keterangan,
															'nama_bulan' => $nama_bulan,
				]);

				if( $save ) {
						return redirect('/libur')
										->with('status_error', 'success')
										->with('pesan_error', 'Data berhasil ditambah.');
				} else {
						return redirect()->back()
										->with('status_error', 'danger')
										->with('pesan_error', 'Data gagal disimpan, terjadi kesalahan');
				}
		}

		public function delete($id)
		{
			$libur  = Libur::findOrFail($id);

			$delete = $libur->delete();
			if($delete) {
				return redirect('/libur')
										->with('status_error', 'success')
										->with('pesan_error', 'Data terhapus');
			}
		}
}

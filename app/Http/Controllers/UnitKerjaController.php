<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

// ambil request
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;

// panggil model
use App\Group;
use App\User;
use App\Kelompok;


class UnitKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $level   = Auth::user()->level;
        $groupid = Auth::user()->group_id;
        if($level=='superadmin') {
            $groups     = Group::all();
        } elseif($level=='admin') {
            $groups     = Group::where('id', $groupid)->get();
        }
        
        return view('adminpanel.unit_kerja.index', compact('groups'));
    }

    /** 55
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminpanel.unit_kerja.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupRequest $request)
    {
        
        // $group = new Group;
        // $group->nama_group      = $request->nama_group;
        // $group->finger_group_id = $request->finger_group_id;
        // $group->active          = $request->active;
        // $save                   = $group->save();

        $nama_group      = $request->input('nama_group');
        $finger_group_id = $request->input('finger_group_id');
        $active          = $request->input('active');

        $save = Group::create([
                                'nama_group' => $nama_group,
                                'finger_group_id' => $finger_group_id,
                                'active' => $active
                            ]);

        if($save) {
            return redirect('/unit/create')
                    ->with('status_error', 'success')
                    ->with('pesan_error', 'Data berhasil ditambah.');
        } else {
            return redirect()->back()
                    ->with('status_error', 'danger')
                    ->with('pesan_error', 'Data gagal disimpan, terjadi kesalahan');
        }
        // catatan : untuk ambil ->with('key', 'value') di view :
        // dg cara {{ Session::get('key') }}
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
        $group = Group::findOrFail($id);
        return view('adminpanel.unit_kerja.update', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupRequest $request, $id)
    {
        $group = Group::findOrFail($id);
        $group->update($request->all());

        return redirect()->back()
                    ->with('status_error', 'success')
                    ->with('pesan_error', 'Data berhasil di update');
        //atau bisa juga dengan cara ini untuk update data
        // $umur = $request->input('umur');
        // $nama = $request->input('nama');
        // $jk = $request->input('jenis_kelamin');
        // Form::where('id', $id)->update([  //Form:: untuk mengakses model form
        //         'nama' => $nama,
        //         'umur' => $umur,
        //         'jenis_kelamin' => $jk
        //     ]);
        // return redirect('form/show/'.$id); //untuk return k id yg diuptae
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();

        return redirect('/unit')
                    ->with('status_error', 'success')
                    ->with('pesan_error', 'Data terhapus');
    }

    public function detail($uid) {
        $group      = Group::findOrFail($uid);
        $anggotas   = User::where('group_id', $uid)->get();
        $kelompoks  = Kelompok::where('group_id', $uid)->get(); 
        return view('adminpanel.unit_kerja.detail', compact('group', 'anggotas', 'kelompoks'));
    }
}

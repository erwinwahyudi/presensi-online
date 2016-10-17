<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ManajemenDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adminpanel.manajemen_data.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadfile(Request $request)
    {
        $bulantahun = $request->bulantahun;
        if(!$request->hasFile('attlogfile')) {
            return "tidak ada file";
        }

        $file       = $request->file('attlogfile');
        // $namafile   = str_random(10).".".$file->getClientOriginalExtension();
        // $lokasi     = public_path().'/attlog';

        $attendanceData = file_get_contents(getcwd(), $file);
         $arrAttendance = explode("\r\n", $attendanceData);
         $arrAttendance = array_slice($arrAttendance, 1, -2);
         
         foreach ($arrAttendance as $attendance) {
             $arrAttendanceLine = explode("\t", trim($attendance));
             echo $hardwareUserId = $arrAttendanceLine[0]." | ";
             echo $timeLog = $arrAttendanceLine[1]." | ";
             echo "<br>";
         }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

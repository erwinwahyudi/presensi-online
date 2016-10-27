<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Libur;

class LiburController extends Controller
{
    public function index()
    {
    	$liburs = Libur::orderBy('tanggal', 'asc')->get();
    	return view('adminpanel.libur.index', compact('liburs'));
    }
}

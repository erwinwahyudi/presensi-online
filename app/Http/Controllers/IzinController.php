<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class IzinController extends Controller
{
    public function index()
    {
    	return view('adminpanel.izin.index');
    }

    public function create(Requests $request)
    {
    	
    }
}

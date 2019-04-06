<?php

namespace sistemaWeb\Http\Controllers;

use Illuminate\Http\Request;

use sistemaWeb\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;


class InicioController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view('inicio.index');
    }

    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
    	
    }

    public function show()
    {
    	
    }

    public function edit()
    {
    	
    }
    public function update()
    {
    	
    }
    public function destroy()
    {
    	
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function orderpending()
    {
        return view('orderpending');
    }

    public function history()
    {
        return view('history');
    }
}

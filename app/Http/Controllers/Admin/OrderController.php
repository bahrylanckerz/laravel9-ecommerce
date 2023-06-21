<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function pending()
    {
        return view('admin.order.pending');
    }

    public function success()
    {
        return view('admin.order.success');
    }
}

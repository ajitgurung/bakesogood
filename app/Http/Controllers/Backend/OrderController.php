<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        return view('');
    }
    public function order(Request $request)
    {
        dd($request->all());
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Category;

class ViewController extends Controller
{
    public function product($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('frontend.product', compact('product'));
    }

    public function shop()
    {
    
    }
}

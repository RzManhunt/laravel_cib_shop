<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
	public function index(){
    	$products = Product::where('featured', true)->take(8)->get();

    	return view('main', ['products' => $products]);
    }
}

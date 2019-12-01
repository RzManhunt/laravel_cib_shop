<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 8;
        $categories = Category::all(); 

        if(request()->category){
            $products = Product::with('categories')->whereHas('categories',
                function($query){
                    $query->where('slug', request()->category);
            });

            $category_name = optional($categories->where('slug', request()->category)->first())->name;
        } else{
            $products = Product::where('featured', true);
            $category_name = 'Featured';
        }
        
        if(request()->orderBy == 'asc'){
            $products = $products->orderBy('price', 'asc')->paginate($pagination);
        } elseif(request()->orderBy == 'desc'){
            $products = $products->orderBy('price', 'desc')->paginate($pagination);
        } else{
            $products = $products->paginate($pagination);
        }

        return view('shop', [
            'products' => $products,
            'categories' => $categories,
            'category_name' => $category_name,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $mightAlsoLike = Product::where('slug', '!=', $slug)->MightAlsoLight(4)->get();

        return view('detail', [
            'product' => $product,
            'mightAlsoLike' => $mightAlsoLike
        ]);
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

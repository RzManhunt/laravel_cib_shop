<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Product;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mightAlsoLike = Product::MightAlsoLight(4)->get();

        return view('cart', [
            'mightAlsoLike' => $mightAlsoLike
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
    public function store()
    {
        $tax = Product::find(request()->id)->tax()->first();

        \Cart::add(request()->id, request()->name, 1, request()->price, $tax->amount, ['slug' => request()->slug, 'details' => request()->details]);

        return redirect()->route('cart.index')->with('success_message', 'El articulo fue agregado al carrito');
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
    public function update(Request $request, $product_id)
    {
        $validator = $this->validate($request,[
            'quantity' => 'required|numeric|between:1,5'
        ]);

        if($validator->fails()){
            session()->flash('error_message', collect(['La cantidad debe estar entre 1 y 5']));
            return response()->json(['success' => false], 400);
        }
        Cart::actualizar($product_id, $request->quantity);

        session()->flash('success_message', 'La cantidad fue actualizada exitosamente');
        return response()->json(['success' => true]);
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

    public function remove()
    {
        \Cart::remove(request()->product_id);

        return redirect()->route('cart.index')->with('success_message', 'El articulo fue eliminado del carrito');
    }
}

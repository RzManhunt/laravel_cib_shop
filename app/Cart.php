<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Cart extends Model
{
	/*
    |--------------------------------------------------------------------------
    | Shopping Cart Model
    |--------------------------------------------------------------------------
    |
    | This Shopping Cart only works for authenticated users.
    | It also has a migration that creates its respective table.
    |
    */


	/**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
	protected $guarded = [];

	/**
     * The content of the 'options' attribute decoded
     *
     * @return array
     */
	public function options()
	{
		$assoc_arr = json_decode($this->options);

		return $assoc_arr;
	}

	/**
     * Present an image path (just for sample images)
     *
     * @return string
     */
	public function presentProductImage(){
		$product_slug = $this->options()->slug;
        $image_name = substr($product_slug, strripos($product_slug, '-') + 1);
        $image_path = 'img/' . $image_name . '.png';
        
        return $image_path;
    }

    /**
     * Present a formatted price including the currency
     *
     * @return string
     */
	public function presentPrice()
	{
		$price = '$' . number_format($this->price, 2, ',', '.');
	    
	    return $price;
	}

	/**
     * Add an item to the cart
     *
     * @var int / array
     *
     * @return model
     */
    public static function add(
	    						$id,
	    						$name = null,
	    						$qty = null,
	    						$price = null,
	    						$tax = null,
	    						$options = null
	    					)
    {
    	if(($user = \Auth::user()) != null)
    	{
    		$user_id = $user->id;
    		$product_id = (is_array($id) && !empty($id))
				    		? $id['id']
				    		: $id;

    		$product_query = Cart::where('user_id', $user_id)
    						->where('product_id', $product_id)
    						->first();

    		$product_not_exists = empty($product_query);

    		if(is_array($id) && !empty($id) && $product_not_exists)
    		{
				$array_model = array(
					'id' => '',
					'name' => '',
					'qty' => '',
					'price' => '',
					'tax' => '',
					'options' => []
				);

				$is_diff = empty(array_diff_key($id, $array_model));

	    		if($is_diff)
	    		{
	    			$name = isset($id['name'])
			    			? $id['name']
			    			: null;	    			
	    			$qty = isset($id['qty'])
			    			? $id['qty']
			    			: null;
			    	$price = isset($id['price'])
			    			? $id['price']
			    			: null;
			    	$tax = isset($id['tax'])
			    			? $id['tax']
			    			: null;
	    			$options = isset($id['options'])
			    			? json_encode($id['options'])
			    			: null;

					$query = Cart::create([
	    				'user_id' => $user_id,
	    				'product_id' => $id['id'],
	    				'name' => $name,
	    				'qty' => $qty,
	    				'price' => $price,
	    				'tax' => $tax,
				        'options' => $options,
				    ]);

	    			return $query;
	    		} else{
	    			return 'El array que usaste no es valido';
	    		}
	    	} elseif(
	    		$product_not_exists
	    		&& (!empty($id) && !is_array($id))
	    	){
				$json = json_encode($options);

    			$query = Cart::create([
	    				'user_id' => $user_id,
	    				'product_id' => $id,
	    				'name' => $name,
	    				'qty' => $qty,
	    				'price' => $price,
				        'options' => $json,
				        'tax' => $tax,
				    ]);

	    		return $query;
	    	} else{
	    		// TODO : mensajes de session para los return
	    		return 'El producto ya existe o no estas usando un array en "options"';
	    	}
    	} else{
    		// NO PARA BOLA
    		return redirect()->route('main')->with(['message' => 'Debes ingresar para poder usar el carrito']);
    	}
    }

    /**
     * Update an item in the cart
     *
     * @var int / array
     *
     * @return model
     */
    public static function actualizar($id, $qty)
    {
    	if(($user = \Auth::user()) != null)
    	{
    		$user_id = $user->id;

    		if(is_array($qty)){    			
    			$quantity = isset($qty['qty'])
						? ['qty' => $qty['qty']]
						: [];
				$name = isset($qty['name'])
						? ['name' => $qty['name']]
						: [];
				$price = isset($qty['price'])
						? ['price' => $qty['price']]
						: [];
				$tax = isset($qty['tax'])
						? ['tax' => $qty['tax']]
						: [];
				$options = isset($qty['options'])
						? ['options' => json_encode($qty['options'])]
						: [];
				$updated_at = ['updated_at' => date('Y-m-d H:i:s')];

				$update_array = array_merge(
									$quantity,
									$name,
									$price,
									$tax,
									$options,
									$updated_at
								);

    			$query = Cart::where('user_id', $user_id)
						->where('product_id', $id)
						->update($update_array);

				return $query;
    		} else{
    			$query = Cart::where('user_id', $user_id)
					->where('product_id', $id)
					->update([
	    				'qty' => $qty,
				        'updated_at' => date('Y-m-d H:i:s')
					]);

				return $query;
    		}
    	} else{
    		// NO PARA BOLA
    		return redirect()->route('main')->with(['message' => 'Debes ingresar para poder usar el carrito']);
    	}
    }

    /**
     * Delete the required product
     *
     * @var int
     *
     * @return bool
     */
    public static function remove($id)
    {
    	if(($user = \Auth::user()) != null)
    	{
    		$user_id = $user->id;

    		$query = Cart::where('user_id', $user_id)
						->where('product_id', $id)
						->delete();

			return $query;
    	} else{
    		// NO PARA BOLA
    		return redirect()->route('main')->with(['message' => 'Debes ingresar para poder usar el carrito']);
    	}
    }

    /**
     * Show the required product
     *
     * @var int
     *
     * @return model
     */
    public static function get($id)
    {
    	if(($user = \Auth::user()) != null)
    	{
    		$user_id = $user->id;

    		$query = DB::table('carts')
					->where('user_id', $user_id)
					->where('product_id', $id)
					->first();

			return $query;
    	} else{
    		// NO PARA BOLA
    		return redirect()->route('main')->with(['message' => 'Debes ingresar para poder usar el carrito']);
    	}
    }

    /**
     * Show the whole content of the for the authenticated user
     *
     * @return collection
     */
    public static function content()
    {
    	if(($user = \Auth::user()) != null)
    	{
    		$user_id = $user->id;

    		$query = Cart::where('user_id', $user_id)->get();

			return $query;
    	} else{
    		// NO PARA BOLA
    		return redirect()->route('main')->with(['message' => 'Debes ingresar para poder usar el carrito']);
    	}
    }

    /**
     * Destroy the cart of the authenticated user
     *
     * @return bool
     */
    public static function destruir()
    {
    	if(($user = \Auth::user()) != null)
    	{
    		$user_id = $user->id;

    		$query = DB::table('carts')
					->where('user_id', $user_id)
					->delete();

			return $query;
    	} else{
    		// NO PARA BOLA
    		return redirect()->route('main')->with(['message' => 'Debes ingresar para poder usar el carrito']);
    	}
    }

    /**
     * Count the total items in cart
     *
     * @return int
     */
    public static function count()
    {
    	if(($user = \Auth::user()) != null)
    	{
    		$user_id = $user->id;

    		$query = Cart::where('user_id', $user_id)->count();

			return $query;
    	} else{
    		// NO PARA BOLA
    		return redirect()->route('main')->with(['message' => 'Debes ingresar para poder usar el carrito']);
    	}
    }

    /**
     * Show the total amount for the entire cart (formatted)
     *
     * @return string
     */
    public static function total(
							    	$decimals = null,
							    	$decimalSeperator = null,
							    	$thousandSeperator = null
							    )
    {
    	if(($user = \Auth::user()) != null)
    	{
    		$user_id = $user->id;

    		$number = Cart::where('user_id', $user_id)->sum('price');

			$total = number_format($number, $decimals, $decimalSeperator, $thousandSeperator);

			return $total;
    	} else{
    		// NO PARA BOLA
    		return redirect()->route('main')->with(['message' => 'Debes ingresar para poder usar el carrito']);
    	}
    }

    /**
     * Show the tax amount for the entire cart (formatted)
     *
     * @return string
     */
    public static function tax(
							    	$decimals = null,
							    	$decimalSeperator = null,
							    	$thousandSeperator = null
							    )
    {
    	if(($user = \Auth::user()) != null)
    	{
    		$user_id = $user->id;

    		$query = Cart::where('user_id', $user_id)->get();

			$tax_arr = array();
			foreach($query as $product){
				$tax_money = $product->price * ($product->tax / 100);

				array_push($tax_arr, $tax_money);
			}

			$number = array_sum($tax_arr);

			$tax = number_format($number, $decimals, $decimalSeperator, $thousandSeperator);

			return $tax;
    	} else{
    		// NO PARA BOLA
    		return redirect()->route('main')->with(['message' => 'Debes ingresar para poder usar el carrito']);
    	}
    }

    /**
     * Show the subtotal amount (total - tax) for the entire cart (formatted)
     *
     * @return string
     */
    public static function subtotal(
							    	$decimals = null,
							    	$decimalSeperator = null,
							    	$thousandSeperator = null
							    )
    {
    	if(($user = \Auth::user()) != null)
    	{
    		$user_id = $user->id;
    	// Calculo el total
	    	$total = Cart::where('user_id', $user_id)->sum('price');
	    // Calculo el tax
	    	$tax_query = Cart::where('user_id', $user_id)->get();

			$tax_arr = array();
			foreach($tax_query as $product){
				$tax_money = $product->price * ($product->tax / 100);

				array_push($tax_arr, $tax_money);
			}

			$tax = array_sum($tax_arr);
		// Calculo y formateo el subtotal
	    	$number = $total - $tax;

	    	$subtotal = number_format($number, $decimals, $decimalSeperator, $thousandSeperator);

	    	return $subtotal;
    	} else{
    		// NO PARA BOLA
    		return redirect()->route('main')->with(['message' => 'Debes ingresar para poder usar el carrito']);
    	}
    }
}
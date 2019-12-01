<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function presentProductImage(){
        $image_name = substr($this->slug, strripos($this->slug, '-') + 1);
        $image_path = 'img/' . $image_name . '.png';
        
        return $image_path;
    }

    public function presentPrice(){
		$price = '$' . number_format($this->price, 2, ',', '.');
    	
    	return $price;
    }

    public function scopeMightAlsoLight($query, $take)
    {
    	return $query->inRandomOrder()->take($take);
    }


    public function tax()
    {
        return $this->belongsTo('App\Tax');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}

<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //

    public function index(){

    	$products = [];

    	$i = 0;

    	foreach (Cart::content() as $key=> $value) {

    		$products[] = [

    			'name' => $value->name,
    			'qty' => $value->qty,
    				];
    		$i++;
    	}

    	$productsSer = serialize($products);

    	$productsUser = unserialize($productsSer);


    	dd($productsUser);
    	return view('checkout.index');
    }
}

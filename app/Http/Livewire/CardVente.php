<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CardVente extends Component
{
	public $price =20;
	public $products;

	public function mount(){
		$this->products = Cart::content();
	}
    public function render()
    {
        return view('livewire.card-vente');
    }

    public function updateProduct($id){
    	dd($id);
    }

    public function changePrice($rowId)
    {
    	// dd($rowId);
    	//Cart::update($rowId, ['price' => $this->price]);
    	$this->products = Cart::content();
    	$this->price = "Je serai un milliardaire";
    }
}

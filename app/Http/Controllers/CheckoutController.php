<?php

namespace App\Http\Controllers;


use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;


class CheckoutController extends Controller
{


    public function store(Request $request)
    {


        if (Cart::count() <= 0) {
            Session::flash('error', 'Votre panier est vide.');
            return redirect()->route('products.index');
        }

        if ($this->noLongerStock()) {
            Session::flash('error', 'Un produit de votre panier ne se trouve plus en stock.');
            return response()->json(['success' => false], 400);
        }

        try {

            DB::beginTransaction();

            $this->stockUpdated();

            $order = Order::create([
                'amount' => Cart::total(),
                'tax' => Cart::tax(),
                'amount_tax' => Cart::subtotal(),
                'products'=> serialize($this->extractCart())

            ]);

            $this->storeTodetailOder($order->id);

             Cart::destroy();

            DB::commit();
            
        } catch (\Exception $e) {

            DB::rollBack();

            Session::flash('error', $e->getMessage());

            return back();
            
        }


        return view('cart.facture', compact('order'));


    }

    public function thankyou()
    {
        return Session::has('success') ? view('checkout.thankYou') : redirect()->route('products.index');
    }



    private function noLongerStock()
    {
        foreach (Cart::content() as $item) {
            $product = Product::find($item->model->id);

            if ($item->qty > $product->quantite) {
                return true;
            }
        }
        return false;
    }

    private function stockUpdated()
    {
        foreach (Cart::content() as $item) {
            $product = Product::find($item->model->id);
            $product->update(['quantite' => $product->quantite - $item->qty]);
        }
    }

    private function storeTodetailOder($order_id){
        foreach (Cart::content() as $item) {

            DetailOrder::create([

                'product_id' => $item->model->id,
                'quantite' => $item->qty,
                'quantite_stock'=> $item->model->quantite,
                'price_unitaire' => $item->price,
                'code_product' => $item->model->code_product,
                'name' => $item->name,
                'unite_mesure' => $item->model->unite_mesure,
                'date_expiration' => $item->model->date_expiration,
                'order_id' => $order_id,

            ]);
            
        }
    }


    private function extractCart(){

        $products = [];
        foreach (Cart::content() as $item) {
            // dump($item);

            $products[] = [
                'id' => $item->id,
                'name' => $item->name,
                'rowId' => $item->rowId,
                'price' => $item->price,
                'quantite' => $item->qty,
                
            ];
        }

        return $products;
    }
}

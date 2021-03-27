<?php

namespace App\Http\Controllers;


use App\Models\Client;
use App\Models\DetailOrder;
use App\Models\FollowProduct;
use App\Models\Order;
use App\Models\PaiementDette;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CheckoutController extends Controller
{

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     

        $request->validate([
            'name' => 'required|min:1',
            'type_paiement' => 'required'

        ]);

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

            $client =  Client::create([
                'name' => $request->name,
                'telephone' => $request->telephone ?? "0000",
                'description' => $request->description ?? ""

            ]);

            $order = Order::create([
                'amount' => Cart::total(),
                'tax' => Cart::tax(),
                'type_paiement' => $request->type_paiement,
                'amount_tax' => Cart::subtotal(),
                'products'=> serialize($this->extractCart()),
                'client'=> $client->toJson(),

            ]);

            $this->storeTodetailOder($order->id);

            if($request->type_paiement == 'DETTE'){
                //Enregistre les infos dans les dettes
                PaiementDette::create([
                    'montant' => Cart::total() ,
                    'montant_restant' =>Cart::total() ,
                    'order_id' =>   $order->id ,
                    'status' => 'NON PAYE'

                ]);
            }

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


            FollowProduct::create([
                'quantite' => $item->qty,
                'details' => $item->model->toJson(),
                'action' => 'VENTE',
                'product_id' => $item->model->id,
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

    public function paimenetDette(){

        $dettes = PaiementDette::sortable()->where('status','=','NON PAYE')
        ->orWhere('montant_restant','>',0)
        ->paginate();

        $totalDette = PaiementDette::all()->where('montant_restant','>',0)->sum('montant_restant');

       
        return view('checkout.paimenet_dette', compact('dettes','totalDette'));
    }
}

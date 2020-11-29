<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('cart.index');
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

        $diplucata = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id == $request->id;
        });

   
        if($diplucata->count()){
            return redirect()->route('ventes.index')->with('success', 'Le produit existe déjà ');
        }

        $product = Product::where('id',$request->id)->firstOrFail();

        Cart::add($product->id, $product->name, 1, $product->price)->associate('App\Models\Product');

        return redirect()->route('ventes.index')->with('success', 'Le produit a été bien ajouter');
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

    public function updatePanier(Request $request){


        $data = $request->all();

    

       $validate = Validator::make($data, [
            'qty' => 'required|numeric|between:1,21'

        ]);

       if($validate->fails()){
         Session::flash('error', 'Les donneés ne sont pas correctes');

        return response()->json(['error','error']);

       }

        Cart::update($data['rowId'], $data['qty']);
        Session::flash('success', 'La quatite a été bien mise à jour');

        return response()->json(['success','réussi']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rowId)
    {
        //



        $data = $request->json()->all();

        Cart::update($rowId, $data['qty']);
        Session::flash('success', 'La quatité mise a jour');

        return response()->json(['success','resussi']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {

        

        Cart::remove($rowId);

        return back()->with('success', 'Suppression avec success');
    }


    
}

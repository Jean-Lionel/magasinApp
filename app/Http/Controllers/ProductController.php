<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FollowProduct;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *'','name','price','date_expiration','quantite','category_id','unite_mesure'
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        //$this->authorize('is-admin');



       // dd(Gate::allows('is-vente'));
    }
    public function index()
    {

        // dd(Gate::allows('is-admin'));

        $this->authorize('view', Product::class);

        $search = \Request::get('search');
        $products = Product::sortable()->where('name','like', '%'.$search.'%')
                            ->orWhere('code_product','like', '%'.$search.'%')
                            ->orWhere('date_expiration','like', '%'.$search.'%')
                            ->orWhere('unite_mesure','like', '%'.$search.'%')
                            ->orWhere('marque','like', '%'.$search.'%')

                            ->latest()->paginate(10);

        return view("products.index", compact('products','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $categories = Category::all();

        return view('products.create',compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     * 'code_product','name','price','date_expiration','quantite'
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
        'name' => 'required|max:255',
        'price' => 'required|numeric|min:0',
        'price_max' => 'required|max:255',
        'code_product' => 'required',
        'date_expiration' => 'required|date',
        'category_id' => 'required',
        'quantite' => 'numeric|min:0',
        'price_min' => 'numeric|min:0',
        'price_max' => 'numeric|min:0',
        'quantite_alert' => 'numeric|min:2',

        ]);

        Product::create($request->all());

        return back()->with('success', 'Enregistrement réussi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //

        return view('products.view', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //

         $categories = Category::all();


        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //'',''


       // $this->authorize('update', $product);

         $request->validate([
        'name' => 'required|max:255',
        'price' => 'required|numeric|min:0',
        'price_max' => 'required|max:255',
        'code_product' => 'required',
        'date_expiration' => 'required|date',
        'quantite' => 'numeric|min:0',
        'price_min' => 'numeric|min:0',
        'price_max' => 'numeric|min:0',
        'quantite_alert' => 'numeric|min:2',

        ]);

         $product->update($request->all());

         return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */


    public function add_view(Product $product){


        return view('products.add',compact('product'));

    }


    public function add_quantite_stock(Request $request){

        $request->validate([
            'quantite' => 'required|numeric|min:0'

        ]);

        try {
            DB::beginTransaction();
              $product = Product::where('id', $request->product_id)->firstOrFail();

              $product->quantite += abs($request->quantite); 

               FollowProduct::create([
                'quantite' => $request->quantite,
                'details' => $product->toJson(),
                'action' => 'ENTRE',
                'product_id' => $product->id,
               ]);

               $product->save();


            DB::commit();
            
        } catch (\Exception $e) {

            DB::rollback();
            
        }

        return $this->index();
    }
}

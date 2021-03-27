<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\DetailPaimentDette;
use App\Models\FollowProduct;
use App\Models\Order;
use App\Models\PaiementDette;
use App\Models\Product;
use App\Models\Stocke;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StockeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stockes = Stocke::latest()->paginate(5);
        return view('stockes/index', compact('stockes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('stockes.create');
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

        $request->validate([
            'name' => 'required|unique:stockes|max:255'
        ]);

        Stocke::create($request->all());

        return $this->index();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stocke  $stocke
     * @return \Illuminate\Http\Response
     */
    public function show(Stocke $stocke)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stocke  $stocke
     * @return \Illuminate\Http\Response
     */
    public function edit(Stocke $stocke)
    {
        return view('stockes.edit', compact('stocke'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stocke  $stocke
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stocke $stocke)
    {
         $request->validate([
            'name' => 'required|max:255'
        ]);

        $stocke->update($request->all());

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stocke  $stocke
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stocke $stocke)
    {
        //

        $stocke->delete();

        return back();
    }


    public function journal(){
        $orders =  Order::sortable()->latest()->paginate(10);
        $products = Product::latest()->paginate(20);

        return view('journals.index', compact('orders','products'));


    }

    public function rapport(){


        $date_recherche = \Request::get('date_recherche');

       

        $paiement_dette = DetailPaimentDette::whereDate('created_at','=',Carbon::now())->sum('montant');

        // La vente journaliere + La somme de paiment des dettes
         $venteJournaliere = Order::where('type_paiement','=','CACHE')->whereDate('created_at','=',Carbon::now())->sum('amount') + $paiement_dette;

         //Historique

         $paiement_dette = DetailPaimentDette::whereDate('created_at','=',$date_recherche)->sum('montant');


        $vente_date = Order::whereDate('created_at','=',$date_recherche)
                            ->where('type_paiement','=','CACHE')
                            ->sum('amount');

        //La somme total du montant en caisse 

        // Tout les factures paye en cache
       // Tout les paiement des dettes - les depenses

        $paiement_dettes_total = DetailPaimentDette::all()->sum('montant');

        $montant_total = Order::where('type_paiement','=','CACHE')->sum('amount') - Depense::all()->sum('montant') +  $paiement_dettes_total ;

        $data_history = DB::select("SELECT name, COUNT(`name`) as nombre_vendu , SUM(`quantite`) as quantite FROM `detail_orders` GROUP by name ORDER BY quantite DESC LIMIT 10");


        $data['product_name'] = collect($data_history)->map->name->implode(",");
        $data['nombre_vendu'] = collect($data_history)->map->nombre_vendu->implode(',');
        $data['quantite'] = collect($data_history)->map->quantite->implode(',');

        $labels = $data['product_name'];

        //$depenses = ;

       // dd($depenses);

          $totalDette = PaiementDette::all()->where('montant_restant','>',0)->sum('montant_restant');


        return view('journals.rapport', 
            compact('venteJournaliere','date_recherche','labels','vente_date','montant_total', 'data','totalDette'));
    }



    public function bonEntre(){

        $s_date = \Request::get('s_date');
        $e_date = \Request::get('e_date');
        $action = \Request::get('action');

        $d = new Carbon($e_date);
        $products = FollowProduct::where('action','=',$action)
                                    ->whereBetween('created_at',[$s_date,  $d->addDays(1)])->paginate();

        return view('products.bon_entre', compact('s_date', 'e_date','products','action'));
    }


}

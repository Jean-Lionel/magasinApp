<?php

namespace App\Http\Controllers;

use App\Models\DetailPaimentDette;
use App\Models\PaiementDette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaiementDetteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        //ceci est definit dans checkOutController

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $dette = \Request::get('dette');

        $dette = PaiementDette::where('id',$dette)->firstOrFail();


        return view('paiment_dette.create', compact('dette'));
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
        'montant' => 'numeric|required|min:0|max:'. $request->montant_restant
       ]);


       try {
        DB::beginTransaction();

         $dette = PaiementDette::where('id', $request->dette_id)->firstOrFail();
        $dette->montant_restant -= $request->montant;

        if($dette->montant_restant == 0)
            $dette->status = 'DEJA PAYE';

        $dette->save();

        DetailPaimentDette::create([
            'paiement_dette_id' =>  $dette->id,
            'montant' => $request->montant
        ]);

        DB::commit();
           
       } catch (\Exception $e) {


        // Session::me

        DB::rollBack();
           
       }


       return back()->with('success', 'Opération réussi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaiementDette  $paiementDette
     * @return \Illuminate\Http\Response
     */
    public function show(PaiementDette $paiementDette)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaiementDette  $paiementDette
     * @return \Illuminate\Http\Response
     */
    public function edit(PaiementDette $paiementDette)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaiementDette  $paiementDette
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaiementDette $paiementDette)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaiementDette  $paiementDette
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaiementDette $paiementDette)
    {
        //
    }
}

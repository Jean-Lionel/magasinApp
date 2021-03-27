<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\Order;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $search = \Request::get('search');

       // $depenses = Depense::latest()->paginate(20);

        $depenses= Depense::latest()->where('name','like', '%'.$search.'%')
                            ->orWhere('description','like', '%'.$search.'%')->paginate(20);

        return view('depenses.index', compact('search', 'depenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('depenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $montant_total = Order::all()->sum('amount') - Depense::all()->sum('montant');

        $request->validate([
            'name' => 'required|min:2',
            'montant' => 'numeric|min:0|max:'. $montant_total,
        ]);

        Depense::create($request->all());

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function show(Depense $depense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function edit(Depense $depense)
    {
        //

        return view('depenses.edit', compact($depense));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Depense $depense)
    {
        $request->validate([
            'name' => 'required|min:2',
            'montant' => 'numeric|min:0'
        ]);

        $depense->update($request->all());

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Depense $depense)
    {
        //
    }
}

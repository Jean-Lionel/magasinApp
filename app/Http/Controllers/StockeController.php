<?php

namespace App\Http\Controllers;

use App\Models\Stocke;
use Illuminate\Http\Request;

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
}

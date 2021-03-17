<?php

namespace App\Http\Controllers;

use App\Seed;
use Illuminate\Http\Request;

class SeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Seed.index');
    }

    public function seed_list(){
        return Seed::all();
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
       $seed = Seed::create($this->validateRequest());
       return response()->json(['data' => $seed]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seed  $seed
     * @return \Illuminate\Http\Response
     */
    public function show(Seed $seed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seed  $seed
     * @return \Illuminate\Http\Response
     */
    public function edit(Seed $seed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seed  $seed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seed $seed)
    {
        $seed->update($this->validateRequest());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seed  $seed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seed $seed)
    {
        $seed->delete();
    }

    public function validateRequest(){

        return request()->validate([
            'seed_name' => 'required',
            'variety' => 'required',
            'unit' => 'required', 
            'quantity' => 'required',
            'cost' => 'required',
            'selling_price' => 'required',
        ]);
    }
}

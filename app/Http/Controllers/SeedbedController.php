<?php

namespace App\Http\Controllers;

use App\Seedbed;
use Illuminate\Http\Request;

class SeedbedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Seedbed.index');
    }

    public function seedbed_list(){

        return Seedbed::all();
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
        $seed_bed = Seedbed::create($this->validateRequest());
        return response()->json(['data' => $seed_bed]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seedbed  $seedbed
     * @return \Illuminate\Http\Response
     */
    public function show(Seedbed $seedbed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seedbed  $seedbed
     * @return \Illuminate\Http\Response
     */
    public function edit(Seedbed $seedbed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seedbed  $seedbed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seedbed $seedbed)
    {
        $seedbed->update($this->validateRequest());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seedbed  $seedbed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seedbed $seedbed)
    {
        $seedbed->delete();
    }

    public function validateRequest(){
        return request()->validate([
            'seedbed_name' => 'required',
            'location' => 'required',
            'seed_capacity' => 'required'
        ]);
    }
}

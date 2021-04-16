<?php

namespace App\Http\Controllers;

use DB;
use App\Pesticide;
use App\PesticideStockIn;
use Illuminate\Http\Request;

class PesticideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Pesticide.index');
    }

    public function pesticide_list()
    {
        return Pesticide::all();
    }

    public function add_pesticide_quantity(Request $request){
        $data = $request->all();
        $pesticide = DB::table('pesticides')->where('id', $data['id'])->first();
        PesticideStockIn::create([
            'quantity_added' => $data['quantity'],
            'pesticide_id' => $data['id'],
            'user_id' => $data['user_id'],
        ]);  

        $current_pesticide_quantity = $pesticide->quantity;
        $current_pesticide_quantity += $data['quantity'];
        $updated_pesticide_quantity = DB::table('pesticides')->where('id', $data['id'])
                            ->update(['quantity' => $current_pesticide_quantity]);    
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
        $pesticide = Pesticide::create($this->validateRequest());
        return response()->json(['data' => $pesticide]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pesticide  $pesticide
     * @return \Illuminate\Http\Response
     */
    public function show(Pesticide $pesticide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pesticide  $pesticide
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesticide $pesticide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pesticide  $pesticide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesticide $pesticide)
    {
        $pesticide->update($this->validateUpdateRequest());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pesticide  $pesticide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesticide $pesticide)
    {
        $pesticide->delete();
    }

    public function validateRequest(){
        return request()->validate([
            'pesticide_name' => 'required',
            'pesticide_brand' => 'required',
            'quantity' => 'required'
        ]);
    }

    public function validateUpdateRequest(){
        return request()->validate([
            'pesticide_name' => 'required',
            'pesticide_brand' => 'required',
        ]);
    }
}

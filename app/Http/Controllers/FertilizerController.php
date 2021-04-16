<?php

namespace App\Http\Controllers;

use DB;
use App\Fertilizer;
use App\FertilizerStockIn;
use Illuminate\Http\Request;

class FertilizerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Fertilizer.index');
    }

    public function fertilizer_list(){
        return Fertilizer::all();
    }

    public function add_fertilizer_quantity(Request $request){        
        $data = $request->all();
        $fertilizer = DB::table('fertilizers')->where('id', $data['id'])->first();
        FertilizerStockIn::create([
            'quantity_added' => $data['quantity'],
            'fertilizer_id' => $data['id'],
            'user_id' => $data['user_id'],
        ]);  

        $current_fertilizer_quantity = $fertilizer->quantity;
        $current_fertilizer_quantity += $data['quantity'];
        $updated_fertilizer_quantity = DB::table('fertilizers')->where('id', $data['id'])
                            ->update(['quantity' => $current_fertilizer_quantity]);    
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
        $fertilizer = Fertilizer::create($this->validateRequest());
        return response()->json(['data' => $fertilizer]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fertilizer  $fertilizer
     * @return \Illuminate\Http\Response
     */
    public function show(Fertilizer $fertilizer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fertilizer  $fertilizer
     * @return \Illuminate\Http\Response
     */
    public function edit(Fertilizer $fertilizer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fertilizer  $fertilizer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fertilizer $fertilizer)
    {
        $fertilizer->update($this->validateUpdateRequest());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fertilizer  $fertilizer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fertilizer $fertilizer)
    {
        $fertilizer->delete();
    }

    public function validateRequest(){
        return request()->validate([
            'fertilizer_name' => 'required',
            'fertilizer_brand' => 'required',
            'quantity' => 'required'
        ]);
    }

    public function validateUpdateRequest(){
        return request()->validate([
            'fertilizer_name' => 'required',
            'fertilizer_brand' => 'required',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use DB;
use App\Seed;
use App\SeedStockIn;
use App\ProductInventory;
use App\Http\Controllers\Auth;
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

    public function add_seed_quantity(Request $request){
        $data = $request->all();
        $seed = DB::table('seeds')->where('id', $data['id'])->first();
        SeedStockIn::create([
            'quantity_added' => $data['quantity'],
            'seed_id' => $data['id'],
            'user_id' => $data['user_id'],
        ]);  

        $current_seed_quantity = $seed->quantity;
        $current_seed_quantity += $data['quantity'];
        $updated_seed_quantity = DB::table('seeds')->where('id', $data['id'])
                            ->update(['quantity' => $current_seed_quantity]);         


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
    
       ProductInventory::create([
           'seed_id' => $seed->id,
       ]);

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

        $seed->update(request()->validate([
            'seed_name' => 'required',
            'variety' => 'required',
        ]));
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
            'quantity' => 'required',
        ]);
    }

    
}

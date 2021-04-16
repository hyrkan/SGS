<?php

namespace App\Http\Controllers;

use App\SeedSowing;
use App\Seed;
use App\Seedbed;
use App\Plot;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SeedSowingController extends Controller
{


    public function index(){


        
        $sowed_list = DB::table('seed_sowings')
        ->join('seeds', 'seed_sowings.seed_id', '=', 'seeds.id')
        ->join('seedbeds', 'seed_sowings.seedbed_id', '=', 'seedbeds.id')
        ->select('seed_sowings.*', 'seeds.seed_name',  'seeds.variety', 'seedbeds.seedbed_name', 'seedbeds.location')
        ->get();



        return response()->json($sowed_list);
    }

    public function getPlot(){
        return Plot::all();
    }

    public function getSeed(){
        
        return Seed::all();
    }

    public function getSeedbed(){
        return Seedbed::all();
    }

    public function seed_sowing(Request $request){


        
        
        $checker = 0;
        $not_enough_seed = true;
        $selected_seed = DB::table('seeds')->where('id', $request->seed_id)->first();
        
        if($request->quantity <= $selected_seed->quantity){
            $checker = $selected_seed->quantity - $request->quantity;

            $selected_seed = DB::table('seeds')->where('id', $request->seed_id)
                ->update(['quantity' => $checker]);
            
            SeedSowing::create($this->validateRequest());
        }

        


        
    }

    public function cultivation(){
        return view('SeedbedMonitoring.index');
    }

    public function today(){

        $today = Carbon::today()->format('Y-m-d');
    

        $for_transfer = DB::table('seed_sowings')
            ->join('seeds', 'seed_sowings.seed_id', '=', 'seeds.id')
            ->join('seedbeds', 'seed_sowings.seedbed_id', '=', 'seedbeds.id')
            ->select('seed_sowings.*', 'seeds.seed_name',  'seeds.variety', 'seedbeds.seedbed_name', 'seedbeds.location')
            ->whereDate('date_transfer', $today)
            ->where('status','=', 0)
            ->get();
        
        return $for_transfer;
    }

    public function validateRequest(){

        return request()->validate([
            'seed_id' => 'required',
            'seedbed_id' => 'required',
            'quantity' => 'required',
            'start' => 'required',
            'date_transfer' => 'required'
        ]);
    }
}

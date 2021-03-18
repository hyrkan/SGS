<?php

namespace App\Http\Controllers;

use App\SeedSowing;
use App\Seed;
use App\Seedbed;
use DB;
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

    public function getSeed(){
        
        return Seed::all();
    }

    public function getSeedbed(){
        return Seedbed::all();
    }

    public function seed_sowing(){

        SeedSowing::create($this->validateRequest());
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

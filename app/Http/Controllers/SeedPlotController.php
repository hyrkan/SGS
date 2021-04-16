<?php

namespace App\Http\Controllers;

use DB;
use App\SeedPlot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SeedPlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    

        $seed_plot = DB::table('seed_plots')
            ->join('plots', 'seed_plots.plot_id', '=', 'plots.id')
            ->select('plots.plot_name','plots.location' , 'seed_plots.*')
            ->get();
        


        return $seed_plot;
    }

    public function cultivation(){
        return view('PlotMonitoring.index');
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

        $seed_plot = request()->all();
        $seed_sowings = DB::table('seed_sowings')->where('id', $seed_plot['seed_sowing_id'])->first();
        $current_quantity = $seed_sowings->quantity;

        foreach($seed_plot['seeded_plots'] as $seed){

            if ($current_quantity > 0){

                SeedPlot::create([
                    'plot_id' => $seed['selected_plot']['id'],
                    'seed_id' => $seed_plot['seed_sowing_id'],
                    'seedling_name' => $seed_plot['seedling_name'],
                    'seedling_variety' => $seed_plot['seedling_variety'],
                    'quantity' => $seed['selected_quantity'],
                    'date_harvest' => $seed['harvest_date'],
                ]);

                $current_quantity -= $seed['selected_quantity'];

                $seed_sowings = DB::table('seed_sowings')->where('id', $seed_plot['seed_sowing_id'])
                            ->update(['quantity' => $current_quantity]);      
                
            }


            $seed_sowings = DB::table('seed_sowings')->where('id', $seed_plot['seed_sowing_id'])
            ->update(['status' => 1]);   
            


            

        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SeedPlot  $seedPlot
     * @return \Illuminate\Http\Response
     */
    public function show(SeedPlot $seedPlot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SeedPlot  $seedPlot
     * @return \Illuminate\Http\Response
     */
    public function edit(SeedPlot $seedPlot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SeedPlot  $seedPlot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SeedPlot $seedPlot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SeedPlot  $seedPlot
     * @return \Illuminate\Http\Response
     */
    public function destroy(SeedPlot $seedPlot)
    {
        //
    }

    public function today(){
        
        $today = Carbon::today()->format('Y-m-d');
        $for_harvest = DB::table('seed_plots')
            ->join('plots', 'seed_plots.plot_id', '=', 'plots.id')
            ->select('plots.plot_name','plots.location' , 'seed_plots.*')
            ->whereDate('date_harvest', $today)
            ->get();
        return $for_harvest;
    }

    public function notify(){
        $basic  = new \Nexmo\Client\Credentials\Basic('5b7db631', '7z4wLW9HAMsHs0Wk');
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => '639751983138',
            'from' => 'Vonage APIs',
            'text' => 'The Seed is now Ready To be Transfered to Another Plot'
        ]);
    }

    
}

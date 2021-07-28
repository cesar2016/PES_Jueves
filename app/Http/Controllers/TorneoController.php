<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Result;
use App\Models\Torneo;
use Carbon\Carbon;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class TorneoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allTorneos = Torneo::select()->orderBy('id', 'DESC')->limit(1)
        //->where('statusTorneo', 'Active')
        ->get(); 

        if ( count($allTorneos) < 1 ) {

          return view('myView/newTorneo');

        }else{

            foreach ($allTorneos as $allTorneo) {

                if($allTorneo->statusTorneo == 'Active'){
                    $status = ['status'=> 'Active'];
                    return view('myView/newTorneo')->with('status', $status);
                    
                }else{
                    return view('myView/newTorneo');
                }
                             
            } 

        }       
        
    }
    public function allTorneos()
    {
        $allTorneos = Torneo::select()
        ->where('statusTorneo', 'Cancelled')
        ->orderBy('id', 'DESC')
        //->where('statusTorneo', 'Active')
        ->get(); 

          return view('myView/allTorneos', compact('allTorneos')); 
        
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
        $date = Carbon::now();
         
        $allTorneos = new Torneo;  
        
        $torneos = $allTorneos->all();

        if(count($torneos) > 0){
       
            foreach ($torneos as $torneo) { 
                $numberTorneo = $torneo->numberTorneo + 1;
            } 
        }else{             
                $numberTorneo = 1;
        }        

        $allTorneos->nameTorneo = $request->input('nameTorneo'); 
        $allTorneos->numberTorneo = $numberTorneo; 
        $allTorneos->dateTorneo = $date;
        $allTorneos->statusTorneo = 'Active';
        $allTorneos->winnerTorneo = 'Sin ganador aun';
        $allTorneos->save();

         

        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $torneo = Torneo::find($id);
        return view('myView/updateNameTorneo', compact('torneo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

         
        $torneo = new Torneo;
        $torneo->where('statusTorneo', 'Active')        
         ->update(
            [
                'statusTorneo'=> 'Cancelled',
                'winnerTorneo'=> $request->player
            ]
        );  

        $result = new Result;
        $updateResult = $result->select()->orderBy('id', 'DESC')->limit(1);

        $updateResult->update(['statusResult'=> 'end']);
        Point::truncate();
        return response()->json($result); 
 
    }
    public function updateNameTorneo(Request $request, $id)
    {
        $torneo = Torneo::find($id);
        $torneo->nameTorneo =  $request->input('newName');
        $torneo->save();

        return redirect('dashboard');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}

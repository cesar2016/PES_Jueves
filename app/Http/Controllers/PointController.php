<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Result;
use App\Models\Torneo;
use Illuminate\Http\Request;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $torneos = Torneo::where('statusTorneo', 'Active')->get();
        $activeTorneo = $torneos->all(); 
 
        $numberAlls = Result::select('results.id as idMatches', 'numberTorneo', 'nameTorneo', 'idMatch', 'idUser', 'goalMore', 'goalLess', 'points')
        ->where('idTorneo', $activeTorneo[0]->numberTorneo ?? '')
        ->leftjoin('torneos', 'results.idTorneo', '=', 'torneos.numberTorneo')
        ->get();

        $players = ['Cesar', 'Tavo', 'Cabu'];

        $forButton = Result::all()->where('statusResult', 'end');        

        if(count($forButton) < 1){
            return view('myView/match', compact('numberAlls', 'players'))->with('nButton', [1]);        
        }else{
            if(count($numberAlls) < 1){

                return view('myView/match', compact('numberAlls', 'players'))
                ->with('message', ['message'=> 'Esperando nuevo torneo']);
            }else{
                return view('myView/match', compact('numberAlls', 'players'));
            }

        } 
         
    }    

    public function matchOld($id)
    {
        $resultsOlds = Result::select()->where('idTorneo', $id)->get();
        $players = ['Cesar', 'Tavo', 'Cabu'];        
        return view('myView/matchOldList', compact('resultsOlds', 'players'));
         
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Point  $points
     * @return \Illuminate\Http\Response
     */
    public function show(Point $point)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function edit(Point $point)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Point $point)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\point  $point
     * @return \Illuminate\Http\Response
     */
    public function destroy(Point $point)
    {
        //
    }
}

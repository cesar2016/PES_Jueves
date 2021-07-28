<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Point;
use App\Models\Result;
use App\Models\Torneo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\Framework\Constraint\Count;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $torneos = Torneo::where('statusTorneo', 'Active')->orderBy('id','ASC')->get();
        $allTorneos = $torneos->all();         
         
        return view('myView/dashboard', compact('allTorneos'));
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
    public function listTable()
    {         
        $torneos = Torneo::where('statusTorneo', 'Active')->get();
        $activeTorneo = $torneos->all();

        $torneoActive = $activeTorneo[0]->numberTorneo ?? '';
        
        $resultsAll = Result::select()
        ->orderBy('points', 'desc')
        ->orderBy('idUser', 'ASC')         
        ->where('idTorneo', $torneoActive)
        ->get();  

        $sumMore1 = 0;
        $sumMore2 = 0;
        $sumMore3 = 0;
        
        $sumLess1 = 0;
        $sumLess2 = 0;
        $sumLess3 = 0;

        foreach ($resultsAll as $result) {         

            if($result->idUser == 1){

                $sumMore1 += $result->goalMore;
                $sumLess1 += $result->goalLess;      
                    
            } 
            if($result->idUser == 2){

                $sumMore2 += $result->goalMore;  
                $sumLess2 += $result->goalLess;     
                            
            } 
            if($result->idUser == 3){

                $sumMore3 += $result->goalMore;     
                $sumLess3 += $result->goalLess;  
                    
            }  

            // INDICAMOS EL PARTIDO N 1
            $firtsmatch = $result->idMatch;

        } 
        
        $goalsPlayersMore = [ $sumMore1, $sumMore2, $sumMore3 ];
        $goalsPlayersLess = [ $sumLess1, $sumLess2, $sumLess3 ];  

        $sumGoalsTotal = 
            [
                $sumMore1 - $sumLess1,
                $sumMore2 - $sumLess2,
                $sumMore3 - $sumLess3
            ];   
        $players = 
            [
                'Cesar',
                'Tavo',
                'Cabu'
            ]; 
        
        $pointsAll = Point::select()      
            ->where('id_Torneo', $torneoActive)
            //->where('id_User')
            ->get();
            
        $pointsTotal = [0, 0, 0];         

        foreach ($pointsAll as $point) {

            $pointsTotal[$point->id_User -1] = $point->points ?? '';
            $pointsTotal[$point->id_User -1] = $point->points ?? '';
            $pointsTotal[$point->id_User -1] = $point->points ?? '';
            
        }
        /* print_r($pointsTotal);
        die(); */ 
        $matchTotal = [ 

            $suma1 = 0,
            $suma2 = 0,
            $suma3 = 0
        
        ];
        
        foreach ( $resultsAll as $results) {

            //echo $results->idUser;

            switch ($results->idUser) 
            {
            case 1:                 
                $matchTotal[0] ++;
                break;
            case 2:
                $matchTotal[1] ++;
                break;
            case 3:
                $matchTotal[2] ++;
                break;
            } 

        }         
        if($firtsmatch ?? '' ){
            //if($firtsmatch ?? '' >= 1){ // Si Recien cominza el torneo

            $finalsPointsAndGoals = [
                $first = [                
                    'points' => '-',
                    'gTotal' => '-',
                    'gMore' => '-',
                    'gLess' => '-',                
                    'player' => '-',
                    'match' => '-',
                ], 
                $second = [                 
                    'points' => '-',
                    'gTotal' => '-',
                    'gMore' => '-',
                    'gLess' => '-',                
                    'player' => '-',
                    'match' => '-',
                ],
                $last = [                 
                    'points' => '-',
                    'gTotal' => '-',
                    'gMore' => '-',
                    'gLess' => '-',
                    'gTotal' => '-',
                    'player' => '-',
                    'match' => '-',
                ],  
            ];
             
            for ($i=0; $i < 3; $i++) {                
                

                $finalsPointsAndGoals[$i]['points'] = $pointsTotal[$i];
                
                $finalsPointsAndGoals[$i]['gMore'] = 
                $goalsPlayersMore[$i] ?? '';
                $finalsPointsAndGoals[$i]['gLess'] = 
                $goalsPlayersLess[$i] ?? '';
                $finalsPointsAndGoals[$i]['gTotal'] = 
                $sumGoalsTotal[$i] ?? '';  
                $finalsPointsAndGoals[$i]['player'] = 
                $players[$i] ?? '' ;
                $finalsPointsAndGoals[$i]['match'] = 
                $matchTotal[$i] ?? ''; 

            }
            arsort($finalsPointsAndGoals); //Ordena primero por puntos y si hay match luego por goles

            /* echo '<pre>'; print_r($finalsPointsAndGoals);
            die(); */ 

            return view('myView/table', compact('finalsPointsAndGoals'));
        }else{
            $finalsPointsAndGoals = [];
            return view('myView/table', compact('finalsPointsAndGoals'))
            ->with('message', ['message'=> 'Esperando nuevo torneo']);
            
        } 
        
        //echo '<pre>'; print_r($finalsPointsAndGoals); 
          
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $resultL = new Result;
        $resultV = new Result; 

        $torneos = new Torneo;
        $allTorneos = $torneos->where('statusTorneo', 'Active')->get(); 
        
        $res = $resultL->all();

        $lastResult = $resultL->select()->orderBy('id', 'DESC')->limit(1)->get();        
 
        foreach ($allTorneos as $torneo) {
            $numberTorneo =  $torneo->numberTorneo;
        }
        
        if(count($res) > 0){

            if($lastResult[0]->statusResult == null){
                foreach ($res as $result) {                
                    $idMatch = $result->idMatch + 1;                 
                }                
            }else{
                $idMatch = 1;
            }

        }else{
            $idMatch = 1;            
        }   

        $pointsLocal = 0;
        $pointsVisiting = 0;

         if($request->input('goalLocal') > $request->input('goalVisiting') ){

            $pointsLocal = 3;             
         }
         if($request->input('goalLocal') < $request->input('goalVisiting') ){

            $pointsVisiting = 3;
         }
         if($request->input('goalLocal') == $request->input('goalVisiting') ){

            $pointsLocal = 1;
            $pointsVisiting = 1;

         }    
         
        $resultL->idMatch = $idMatch;
        $resultL->idTorneo = $numberTorneo;
        $resultL->idUser = $request->input('playerLocal');                 
        $resultL->goalMore = $request->input('goalLocal');
        $resultL->goalLess = $request->input('goalVisiting');
        $resultL->points = $pointsLocal;                 
        $resultL->save();

        $resultV->idMatch = $idMatch;
        $resultV->idTorneo = $numberTorneo;
        $resultV->idUser = $request->input('playerVisiting');                  
        $resultV->goalMore = $request->input('goalVisiting');
        $resultV->goalLess = $request->input('goalLocal');
        $resultV->points = $pointsVisiting;
        $resultV->save();
        //End insert de RESULTADOS 

        // ------- INSERT DE LOS PUNTOS ----//                

        $playerLocal = $request->input('playerLocal');
        $playerVisiting = $request->input('playerVisiting'); 

        $searchPalyerL = Point::select()->where('id_User', $playerLocal)->get();
        $searchPalyerV = Point::select()->where('id_User', $playerVisiting)->get();

        $goalMatchLocal = $request->input('goalLocal');
        $goalMatchVisiting = $request->input('goalVisiting');
         
        if(count($searchPalyerL) == 0 && count($searchPalyerV) == 0 ){

            $this->zeroGamePoints($playerLocal, $playerVisiting,  $idMatch, $numberTorneo, $pointsLocal, $pointsVisiting, $goalMatchLocal, $goalMatchVisiting);

        }
        if(count($searchPalyerL) == 1 && count($searchPalyerV) == 1 ){
             
            $this->twoGamePoints($playerLocal, $playerVisiting, $pointsLocal, $pointsVisiting, $goalMatchLocal, $goalMatchVisiting);

        }
        if(count($searchPalyerL) == 1 && count($searchPalyerV) == 0 ){
            
            $this->localGamePoints($playerLocal, $playerVisiting, $idMatch, $numberTorneo, $pointsLocal, $pointsVisiting, $goalMatchLocal, $goalMatchVisiting);

        }
        if(count($searchPalyerL) == 0 && count($searchPalyerV) == 1 ){
             

            $this->visitingGamePoints($playerLocal, $playerVisiting, $idMatch, $numberTorneo, $pointsLocal, $pointsVisiting, $goalMatchLocal, $goalMatchVisiting);

        }          
 
        return redirect('table'); 
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
       
        $resultEdit = Result::select()
        ->where('idMatch', $id)
        ->get();      
         //return $resultEdit;
        return view('myView/editMatch', compact('resultEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idl, $idv )
    { 

        $points = $this->calculoPoints($request->input('goalLocal'), $request->input('goalVisiting')); 

        $resultUpdateL = Result::find($idl);
        $resultUpdateV = Result::find($idv);  
        
        $resultUpdateL
         ->update(
            [
                'idUser'=> $request->input('playerLocal'),
                'goalMore'=> $request->input('goalLocal'),
                'goalLess'=> $request->input('goalVisiting'),
                'points'=> $points[0]
            ]
        );

        $resultUpdateV
         ->update(
            [
                'idUser'=> $request->input('playerVisiting'),
                'goalMore'=> $request->input('goalVisiting'),
                'goalLess'=> $request->input('goalLocal'),
                'points'=> $points[1]
            ]
        );

        // # UPADATE POINTS
        $points[0] >= $points[1] ? $uploadL = 'suma' : $uploadL = 'resta';
        $points[1] >= $points[0] ? $uploadV = 'suma' : $uploadV = 'resta';       

        $pointUpdateL = Point::select()
        ->where('id_Torneo', $resultUpdateL->idTorneo )
        ->where('id_User', $resultUpdateL->idUser )
        ->get();

        $pointUpdateV = Point::select()
        ->where('id_Torneo', $resultUpdateV->idTorneo )
        ->where('id_User', $resultUpdateV->idUser )
        ->get();

        $uploadL == 'suma' ? $newPointL = $pointUpdateL[0]->points + $points[0] : $newPointL = $pointUpdateL[0]->points - $points[0];
        $uploadV == 'suma' ? $newPointV = $pointUpdateV[0]->points + $points[1] : $newPointV = $pointUpdateV[0]->points - $points[1];
 
        Point::find($pointUpdateV[0]->id)        
         ->update(
            [
                'points'=> $newPointL                 
            ]
        );

        Point::find($pointUpdateV[0]->id)        
         ->update(
            [
                'points'=> $newPointV             
            ]
        ); 
        return Redirect::route('match');
         
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

    // -------------- My INSERT  --------

    public function zeroGamePoints($local, $visiting, $idMatch, $numberTorneo, $pointsLocal, $pointsVisiting, $goalMatchLocal, $goalMatchVisiting)
    {   
        $pointsL = new Point;
        $pointsV = new Point;

        $pointsL->id_Match = $idMatch;
        $pointsL->id_Torneo = $numberTorneo;
        $pointsL->id_User = $local;                                       
        $pointsL->points = $pointsLocal;
        $pointsL->save();
            
        $pointsV->id_Match = $idMatch;
        $pointsV->id_Torneo = $numberTorneo;
        $pointsV->id_User = $visiting;                  
        $pointsV->points = $pointsVisiting;
        $pointsV->save();  
         
        // GOALS NOTES;

        $goalsL = new Goal;
        $goalsV = new Goal;

        $goalsL->id_Match = $idMatch;
        $goalsL->id_Torneo = $numberTorneo;
        $goalsL->id_User = $local;                                       
        $goalsL->total_Goals = $goalMatchLocal;
        $goalsL->save();
            
        $goalsV->id_Match = $idMatch;
        $goalsV->id_Torneo = $numberTorneo;
        $goalsV->id_User = $visiting;                  
        $goalsV->total_Goals = $goalMatchVisiting;
        $goalsV->save();   

    }

    public function twoGamePoints($local, $visiting, $pointsLocal, $pointsVisiting, $goalMatchLocal, $goalMatchVisiting)
    {
        $pointsL = new Point;
        $pointsV = new Point;

        $pointsLocalAlls = Point::select()
            ->where('id_User', $local)
            ->get();

        $pointsVisitingAlls = Point::select()
        ->where('id_User', $visiting)
        ->get();

        $pointsLocalAcum = 0;
        foreach($pointsLocalAlls as $point){
            $pointsLocalAcum += $point->points; 

        }
        
        $pointsVisitingAcum = 0;
        foreach($pointsVisitingAlls as $point){
            $pointsVisitingAcum += $point->points; 

        }

        $pointsL->where('id_User', $local)
        ->update(['points'=> $pointsLocalAcum + $pointsLocal]); 

        $pointsV->where('id_User', $visiting)
        ->update(['points'=> $pointsVisitingAcum + $pointsVisiting]); 
        
        // GOALS NOTES;

        $goalsL = new Goal;
        $goalsV = new Goal;

        $goalsLocalAlls = Goal::select()
            ->where('id_User', $local)
            ->get();

        $goalsVisitingAlls = Goal::select()
        ->where('id_User', $visiting)
        ->get();

        $goalsLocalAcum = 0;
        foreach($goalsLocalAlls as $goals){
            $goalsLocalAcum += $goals->total_Goals; 

        }
        
        $goalsVisitingAcum = 0;
        foreach($goalsVisitingAlls as $goals){
            $goalsVisitingAcum += $goals->total_Goals; 

        } 

        $goalsL->where('id_User', $local)
        ->update(['total_Goals'=> $goalsLocalAcum + $goalMatchLocal]); 

        $goalsV->where('id_User', $visiting)
        ->update(['total_Goals'=> $goalsVisitingAcum + $goalMatchVisiting]); 
         
    }
    public function localGamePoints($local, $visiting, $idMatch, $numberTorneo, $pointsLocal, $pointsVisiting, $goalMatchLocal, $goalMatchVisiting)
    {
        $pointsL = new Point;
        $pointsV = new Point;

        $points = Point::select()
            ->where('id_User', $local)
            ->get();

        $pointsLocalAcum = 0;
        foreach($points as $point){
            $pointsLocalAcum += $point->points; 

        }
        $pointsL->where('id_User', $local)
        ->update(['points'=> $pointsLocalAcum + $pointsLocal]);

        $pointsV->id_Match = $idMatch;
        $pointsV->id_Torneo = $numberTorneo;
        $pointsV->id_User = $visiting;                  
        $pointsV->points = $pointsVisiting;
        $pointsV->save(); 

        // GOALS NOTES;

        $goalsL = new Goal;
        $goalsV = new Goal;

        $goalsLocalAlls = Goal::select()
            ->where('id_User', $local)
            ->get();

        $goalsLocalAcum = 0;
        foreach($goalsLocalAlls as $goals){
            $goalsLocalAcum += $goals->total_Goals; 

        }

        $goalsL->where('id_User', $local)
        ->update(['total_Goals'=> $goalsLocalAcum + $goalMatchLocal]); 
         
            
        $goalsV->id_Match = $idMatch;
        $goalsV->id_Torneo = $numberTorneo;
        $goalsV->id_User = $visiting;                  
        $goalsV->total_Goals = $goalMatchVisiting;
        $goalsV->save();   


    }
    public function visitingGamePoints($local, $visiting, $idMatch, $numberTorneo, $pointsLocal, $pointsVisiting, $goalMatchLocal, $goalMatchVisiting)
    {
        $pointsL = new Point;
        $pointsV = new Point;

        $points = Point::select()
            ->where('id_User', $visiting)
            ->get();

        $pointsVisitingAcum = 0;
        foreach($points as $point){
            $pointsVisitingAcum += $point->points; 

        } 

        $pointsV->where('id_User', $visiting)
        ->update(['points'=> $pointsVisitingAcum + $pointsVisiting]);

        $pointsL->id_Match = $idMatch;
        $pointsL->id_Torneo = $numberTorneo;
        $pointsL->id_User = $local;                  
        $pointsL->points = $pointsLocal;
        $pointsL->save(); 

        // GOALS NOTES;

        $goalsL = new Goal;
        $goalsV = new Goal;

        $goalsLocalAlls = Goal::select()
            ->where('id_User', $visiting)
            ->get();

        $goalsVisitingAcum = 0;
        foreach($goalsLocalAlls as $goals){
            $goalsVisitingAcum += $goals->total_Goals; 

        }

        $goalsV->where('id_User', $visiting)
        ->update(['total_Goals'=> $goalsVisitingAcum + $goalMatchVisiting]);          
            
        $goalsL->id_Match = $idMatch;
        $goalsL->id_Torneo = $numberTorneo;
        $goalsL->id_User = $local;                  
        $goalsL->total_Goals = $goalMatchLocal;
        $goalsL->save(); 
    }

    public function calculoPoints($gl, $gv)
    {
        /* $pointsLocal = 0;
        $pointsVisiting = 0; */

        $points = [];

         if($gl > $gv ){

            //$pointsLocal = 3;  
            array_push($points, 3, 0 );           
         }
         if($gl < $gv ){

            //$pointsVisiting = 3;
            array_push($points, 0, 3 );
         }
         if($gl == $gv ){

            /* $pointsLocal = 1;
            $pointsVisiting = 1; */
            array_push($points, 1, 1 );

         }    

         return $points;
    }


}

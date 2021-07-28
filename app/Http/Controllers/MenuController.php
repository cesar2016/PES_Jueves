<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {

         
        
        $torneos = Torneo::where('statusTorneo', 'Active')->orderBy('id','ASC')->get();
        $allTorneos = $torneos->all();         
         
        return view('layouts/general', compact('allTorneos'));
    }
}

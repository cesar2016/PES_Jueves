@extends('layouts.general')

@section('content')
<table class="table">
     <thead>
       <tr class="text-center">         
         <th scope="col">#</th>
         <th scope="col"><i class="fas fa-running"></i></th>
         <th scope="col"><i class="fas fa-portrait"></i></th>
         <th scope="col">+ <i class="fas fa-futbol"></i></th>
         <th scope="col">- <i class="fas fa-futbol"></i></th>
         <th scope="col"><i class="fas fa-calculator"></i></th>
       </tr>
     </thead>
     <tbody>        
     @foreach ($resultsOlds as $resultsOld)
     
       <tr class="text-center">  
          <td>{{ $resultsOld->idTorneo }}</td> 
          <td>  
            P {{ $resultsOld->idMatch }}          
          </td>      
          <th scope="row">{{ $players[$resultsOld->idUser -1] }}</th>
          <td>{{ $resultsOld->goalMore }}</td>            
          <td>{{ $resultsOld->goalLess }}</td>  
          <td>{{ $resultsOld->points }}</td>
     @endforeach 
       </tr>   
     </tbody>
   </table>
@endsection
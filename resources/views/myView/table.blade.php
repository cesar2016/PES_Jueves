@extends('layouts.general')

@section('content')
<table class="table">
     <thead>
       <tr class="text-center">
         <th scope="col"><i class="fas fa-user-shield"></i></th>
         <th scope="col"><i class="fas fa-calculator"></i></th>
         <th scope="col"><i class="fas fa-futbol"></i> +-</th>
          <th scope="col"><i class="fas fa-running"></i></i></th>
       </tr>
     </thead>
     <tbody>
       @if ($message['message'] ?? '')
        <div class="alert alert-primary">{{ $message['message'] ?? '' }}</div> 
       @endif    
       
      @php
       $first = []; 
      @endphp
      @foreach ( $finalsPointsAndGoals as $points)  
      
      @php
          array_push($first, $points['player']);
      @endphp
      
       <tr class="text-center"

       @if ($points['match'] == 0)
          style="color: #ccc" 
       @endif 

       >        
         <th class="text-default" scope="row">

             @if ($points['player'] == $first[0])

              {{$points['player']}} <i class="fas fa-medal text-danger"></i>             
                 
             @else
              {{$points['player']}}              
             @endif             
          
          </th>
          
          <td> {{ $points['points'] }} </td>            
          <td>  
              <small>+{{ $points['gMore'] }}</small>                          
              <small>-{{ $points['gLess'] }}</small> = 
              <strong class="text-link">
                {{ $points['gTotal'] }}   
              </strong>                   
          </td>
         
         <td> P {{ $points['match'] }} </td>
                
       </tr>             
       @endforeach 
     </tbody>
   </table>
@endsection
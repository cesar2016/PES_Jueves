@extends('layouts.general')

@section('content')

@if ($nButton ?? '')
      <strong>Aun no hay torneos guardados ...</strong>
@else

<a href="{{route('allTorneos')}}" class="btn btn-primary">
  <i class="fa fa-plus"> Viejos</i>
</a> 
   
@endif


<table class="table">
     <thead>
       <tr class="text-center">         
         <th scope="col"><i class="fas fa-award"></i></th>
         <th scope="col"><i class="fas fa-running"></i></th>
         <th scope="col"><i class="fas fa-portrait"></i></th>
         <th scope="col">+ <i class="fas fa-futbol"></i></th>
         <th scope="col">- <i class="fas fa-futbol"></i></th>
         <th scope="col"><i class="fas fa-calculator"></i></th>
       </tr>
     </thead>
     <tbody> 
        @if ($message['message'] ?? '')
          <div class="alert alert-primary">{{ $message['message'] ?? '' }}</div> 
        @endif
     @foreach ($numberAlls as $numberAll) 
       <tr class="text-center">  
          <td>{{ $numberAll->numberTorneo }} {{ $numberAll->nameTorneo }}</td> 
          <td>  
            <a href="/result/{{$numberAll->idMatch}}/edit" class="btn btn-primary btn-sm" role="button" >P {{ $numberAll->idMatch }}</a>           
          </td>      
          <th scope="row">{{ $players[$numberAll->idUser -1] }}</th>
          <td>{{ $numberAll->goalMore }}</td>            
          <td>{{ $numberAll->goalLess }}</td>  
          <td>{{ $numberAll->points }}</td>
     @endforeach 
       </tr>   
     </tbody>
   </table>
@endsection
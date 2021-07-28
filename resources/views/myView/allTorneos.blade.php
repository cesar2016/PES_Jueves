@extends('layouts.general')

@section('content')
 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
<table id="torneos" class="table table-striped table-bordered" style="width:100%"> 
 <h3>Torneos Jugados</h3> 
     <thead>
       <tr class="text-center text-sm">         
         <th scope="col">#</th>
         <th scope="col">GANADOR</th>
         <th scope="col">TORNEO</i></th>
         <th scope="col">FECHA</i></th>          
       </tr>
     </thead>
     <tbody> 
     @foreach ($allTorneos as $allTorneo)       
       <tr class="text-center">  
          <td>{{ $allTorneo->numberTorneo }}</td> 
          <td>  
            <strong>{{$allTorneo->winnerTorneo}}</strong>        
          </td>      
          <th><a href="{{route('matchOld', $allTorneo->numberTorneo)}}" class="btn btn-primary btn-sm" role="button" >{{ $allTorneo->nameTorneo }}</a>           </th>
          <td>
            @php
                $myDate = $allTorneo->dateTorneo;
                $newDate = date("d/m/Y H:i:s", strtotime($myDate));
            @endphp
            <small>{{ $newDate }}</small>
            </td> 
     @endforeach 
       </tr>   
     </tbody>
   </table>

   
<!-- JavaScript DataTablet --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script> 

<script> 

$('#torneos').DataTable(); 

</script>
   
@endsection
 
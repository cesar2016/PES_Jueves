@extends('layouts.general')

@section('content')

<div id="contentAll" >
<div class="row mb-3"> 

@if ($allTorneos == [])
    <div class="alert alert-danger">Ups!, No hay torneos Activos, inicia uno</div>
    @else    

 @foreach ($allTorneos as $torneo) 
     
 @endforeach

 
@if ($torneo->statusTorneo == 'Cancelled') 
    <div class="alert alert-danger">Ups!, No hay torneos Activos, inicia uno 
        
    </div>
@else
    <a href="{{route('editNameTorneo', $allTorneos[0]->id) }}">
        <strong><small> Anotar resultado Torneo  </small> {{ $torneo->nameTorneo}} </strong> 
    </a>  
    <div class="col-8">
            <form action="{{ route('insertResult') }}" method="POST" >
                @csrf
            <select class="form-control input-lg" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="playerLocal" id="playerLocal">                    
                <option value="0"> ... </option>
                <option value="1">Cesar</option>
                <option value="2">Tavo</option>
                <option value="3">Cabu</option>
            </select>
        </div>
        <div class="col-4">
            <select class="form-control input-lg" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="goalLocal" id="goalLocal">
                <option selected value="0">0</option>                     
                    @for ($i=1; $i <= 15; $i++) { 
                        <option value="{{$i}}" >{{$i}}</option>
                    @endfor                     
            </select>
        </div>
    </div> 
    <div id="boxVisiting" class="row mb-3">
        <div class="col-8">
            <select class="form-control input-lg" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="playerVisiting" id="playerVisiting">
                <option value="0"> ... </option>
                <option value="1">Cesar</option>
                <option value="2">Tavo</option>
                <option value="3">Cabu</option>
            </select>
        </div>   
        <div class="col-4">
            <select class="form-control input-lg" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="goalVisiting" id="goalVisiting">
                <option selected value="0">0</option>                     
                    @for ($i=1; $i <= 15; $i++) { 
                        <option value="{{$i}}" >{{$i}}</option>
                    @endfor 
            </select>
        </div>
        <span id="message" class="text-danger"></span>
    </div>   
    <button id="btnSend" type="submit" class="btn btn-danger btn-lg btn-block"> 
        OK <i class="fas fa-pencil-alt"></i> 
    </button>
    </form> 
    

@endif
@endif    
  
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
         

        $('#btnSend').prop('disabled', true);         
        $('#goalVisiting').prop('disabled', true);
        $('#playerVisiting').prop('disabled', true);
        

        
        $('#playerLocal').change(function() { 

            if($('#playerLocal').val() > 0){
                 
                $('#goalVisiting').prop('disabled', false);
                $('#playerVisiting').prop('disabled', false);
            }else{
                 
                $('#goalVisiting').prop('disabled', false);
                $('#playerVisiting').prop('disabled', false);
            }
            if($('#playerLocal').val() < 1){

                $('#message').text('')     
                $('#btnSend').prop('disabled', true);
                $('#goalVisiting').prop('disabled', true);
                $('#playerVisiting').prop('disabled', true);

            }
             
             
            
        });
        $('#playerVisiting').change(function() { 
             
            if($('#playerVisiting').val() > 0){ 
                if($('#playerVisiting').val() != $('#playerLocal').val() ){                
                    $('#btnSend').prop('disabled', false)
                    $('#message').text('')
                    
                }
                if($('#playerVisiting').val() == $('#playerLocal').val() ){     
                    $('#btnSend').prop('disabled', true)
                    $('#message').text('Ups! Los jugadores son iguales')
                }
                else{
                    
                    
                }
            }else{
                $('#message').text('')     
                $('#btnSend').prop('disabled', true);            
            }
             
            //$('#btnSend').prop('disabled', false);
            
        });
         
         
    });
</script>
@endsection
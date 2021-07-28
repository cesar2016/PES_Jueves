@extends('layouts.general')

@section('content')

<div id="contentAll" >
<div class="row mb-3"> 
    @php
        $players = ['Cesar', 'Tavo', 'Cabu'];
    @endphp 
    <strong class="text-center">MODIFICAR DATOS DE LA FECHA <i class="fas fa-exchange-alt"></i></strong> 
<div class="col-8">
        <form action="{{route('updateResult',[ $resultEdit[0]->id,$resultEdit[1]->id])}}" method="POST" >
            @csrf @method('PUT')
        <select class="form-control input-lg" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="playerLocal" id="playerLocal">                    
            <option value="{{$resultEdit[0]->idUser}}"> {{$players[$resultEdit[0]->idUser-1]}} </option>
            <option id="l1" value="1">Cesar</option>
            <option id="l2" value="2">Tavo</option>
            <option id="l3" value="3">Cabu</option>
        </select>
    </div>
    <div class="col-4">
        <select class="form-control input-lg" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="goalLocal" id="goalLocal">
            <option selected value="{{$resultEdit[0]->goalMore}}">{{$resultEdit[0]->goalMore}}</option>            
            <option value="0">0</option>                     
                @for ($i=1; $i <= 15; $i++) { 
                    <option value="{{$i}}" >{{$i}}</option>
                @endfor                     
        </select>
    </div>
</div> 
<div id="boxVisiting" class="row mb-3">
    <div class="col-8">
        <select class="form-control input-lg" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="playerVisiting" id="playerVisiting">
            <option selected value="{{$resultEdit[1]->idUser}}"> {{$players[$resultEdit[1]->idUser-1]}} </option>
            <option id='v1' value="1">Cesar</option>
            <option id='v2' value="2">Tavo</option>
            <option id='v3' value="3">Cabu</option>
        </select>
    </div>   
    <div class="col-4">
        <select class="form-control input-lg" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="goalVisiting" id="goalVisiting">
            <option selected value="{{$resultEdit[1]->goalMore}}">{{$resultEdit[1]->goalMore}}</option>
            <option value="0">0</option>                     
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
   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){ 
        var playerL = {!! json_encode($resultEdit[0]->idUser) !!};
        var playerV = {!! json_encode($resultEdit[1]->idUser) !!};         

        $('#l'+playerL).hide();
        $('#v'+playerV).hide();
    

         
         
    });
</script>
@endsection
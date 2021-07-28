@extends('layouts.general')

@section('content')

<div id="contentAll" >
    <form action="{{ route('updateNameTorneo', $torneo) }}" method="POST" >
                @csrf @method('PUT')
        <div id="boxVisiting" class="row mb-3">
            <div class="col-12">
                <input type="text" id="name" value="{{ $torneo->nameTorneo }}" placeholder="Nuevo nombre" name="newName" class="form-control input-lg" aria-label="Large" aria-describedby="inputGroup-sizing-sm" >                 
            </div> 
            
            <span id="message" class="text-danger"></span>
        </div>   
        <button id="btnSend" type="submit" class="btn btn-success btn-lg btn-block"> 
            CAMBIAR <i class="fas fa-pencil-alt"></i> 
        </button>
    </form>  
   
</div> 
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){ 

        $('#btnSend').prop("disabled", false)
        
        $('#name').keyup(function (e) { 
            $('#name').val()
            if($('#name').val() < 2){
                $('#btnSend').prop("disabled", true)
            }else{
                $('#btnSend').prop("disabled", false)
            }                    
        });
             
        
         
    });
</script>
@endsection
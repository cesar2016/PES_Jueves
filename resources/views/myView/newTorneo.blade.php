@extends('layouts.general')

@section('content')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
<div class="row mb-3">
    <strong>Ingresa un nombre para el torneo</strong>
 
     
    <div class="col-12">
        <form action="{{ route('newTorneo') }}" method="POST" >
            @csrf
        <input type="text" class="form-control input-lg" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="nameTorneo" id="nameTorneo">                    
             
    </div>     
</div> 

<button id="btnSend" type="submit" class="btn btn-danger btn-lg btn-block"> 
    OK <i class="fas fa-pencil-alt"></i> 
</button>
</form>    
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<script>
    $(document).ready(function(){  
        if({!! json_encode($status ?? '') !!}){

            var status = {!! json_encode($status ?? '')!!};        

            // # SwitAlert
            Swal.fire({
                imageUrl: 'https://media.tycsports.com/files/2021/06/04/289982/colon-racing-en-pes-2021-error-gol-tempranero-y-titulo-asi-fue-la-simulacion-de-la-final-de-la-copa-lpg_416x234.jpg',
                title: 'Ups... hay un torneo Activo',
                text: '¿Deseas terminarlo?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `SI`,
            denyButtonText: `NO`,
            allowOutsideClick: false,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Swal.fire({            
                title: '¿El campeon fue?',
                input: 'select',
                inputOptions: {             
                    'Jugadores': {                 
                    Cesar: 'CESAR',
                    Tavo: 'TAVO',
                    Cabu: 'CABU'            
                    }        
                },
                inputPlaceholder: 'Elegi un jugador',
                inputAttributes: {
                    autocapitalize: 'off'
                }, 
                inputValidator: (value) => {
                return new Promise((resolve) => {
                    if (value.length > 0) {
                        resolve()
                    } else {
                        resolve('Debe elegir un ganador :)')
                    }
                    })
                },               
                showCancelButton: true,                
                confirmButtonText: 'Enviar',
                showLoaderOnConfirm: true,     
                allowOutsideClick: false,    
                allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) { 
                        
                        // INSERTANDO DTOS CON FETCH
                        fetch( '{{route("end")}}', { //NOMBE DE LA RUTA - no URL
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-Token": $('input[name="_token"]').val()
                            },
                            method: "post",
                            credentials: "same-origin",
                            body: JSON.stringify({
                                player: result.value                        
                            })
                        })
                        .then(response => response.text())
                        .then(data => {
                            console.log(data);
                        }); 

                        Swal.fire({
                        title: `Congrats... ${result.value} !!!`,
                        imageUrl: 'https://images.lavoz.com.ar/resizer/p2aWDLHHj1ORsHpuGfX8BzUNcqo=/1023x682/smart/cloudfront-us-east-1.images.arcpublishing.com/grupoclarin/UI5O5B6Q2VES7G7NLNSZN6FULI.jpg',
                        })                
                    }else{
                        window.location.href = "{{ route('dashboard') }}";
                    }
                })
            } else if (result.isDenied) {
                window.location.href = "{{ route('dashboard') }}";
                }
            })

        }//End If   
         
    });
</script>
@endsection
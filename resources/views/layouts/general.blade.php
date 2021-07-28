<!-- CSS only -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-red-800 leading-tight">
            {{ env('APP_NAME')}} {{date('Y') }} 
            <a href="{{route('newTorneo')}}" type="button" class="btn btn-info ml-5">
                NT <i class="fas fa-trophy float-rigth"></i>
            </a>
        </h2>               
    </x-slot>    
<!-- CSS only -->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script> --}}
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<style>
    .raw {   
  margin-top: 50px;
  text-align: center;
  
}
    .row > div{
  background: #f2f2f2;
  padding: 20px;
  border: 1px solid rgb(209, 204, 204);   

}
.input-lg{
  height: 70px;
  font-family: Arial, Helvetica, sans-serif;
  font-size: 30px;

}

</style> 

    <div class="container"> 
        <div class="raw mb-5 btn-group">
            
                 <a href="{{ route('dashboard') }}" type="button" class="btn btn-outline-danger">
                    ANOTAR
                </a>
                 <a href="{{ route('table') }}" type="button" class="btn btn-outline-danger">
                    POSICIONES
                </a>
                 <a href="{{ route('match') }}" type="button" class="btn btn-outline-danger">
                    PARTIDOS
                </a>           
             
        </div> 
 
        @yield('content') 
    </div>
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://kit.fontawesome.com/e8003860b2.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> 
  
</x-app-layout>

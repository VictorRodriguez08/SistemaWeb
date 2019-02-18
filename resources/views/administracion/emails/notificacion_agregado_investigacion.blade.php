@php
    switch ($tipo){
        case 1:
            $tipo = "Alumno";
            break;
        case 2:
            $tipo = "Asesor";
            break;
        case 3:
            $tipo = "Jurado";
            break;
    }
@endphp
<h1>Estimado {{$nombre_usuario}}</h1>
<h2>Ha sido agregado a {{$nombre_investigacion}} como <b>{{$tipo}}</b></h2>
<h2>Ingrese al siguiente <a href="{{Request::root()}}/tesis">link</a> para revisar los datos </h2>

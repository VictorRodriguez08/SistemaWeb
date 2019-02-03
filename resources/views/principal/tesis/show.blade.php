@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-sm-10">Titulo</div>
        <div class="col-sm-2">Estado</div>
    </div>
    <div class="row">
        <div class="col-sm-6">Fecha de Inicio</div>
        <div class="col-sm-6">Fecha fin</div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12 col-md-4">
            <h4>Lista de Archivos</h4>
        </div>
        <div class="col-sm-12 col-md-4">
            <a href="#" class="btn btn-info" id="btnAgregarArchivo">Agregar archivo</a>
        </div>
        <div class="col-sm-12 col-md-4">
            <a href="#" class="btn btn-warning" id="btnAgregarObservaciones">Agregar Observaciones</a>
        </div>
    </div>
    <div class="hidden" id="dropzoneArchivo">
        <form action="{{URL::action('TesisController@SubirArchivo')}}"
              class="dropzone" id="form-subir-archivo">
            <input type="hidden" name="tesis_id" value="{{$tesis->id}}">
            <input type="hidden" name="tipo_archivo" value="{{$tesis->estado->id}}">
            <div class="dz-message" data-dz-message><span>Arrastre el archivo que desea subir aquí</span></div>
            {{ csrf_field() }}
        </form>
    </div>
    <div class="hidden" id="dropzoneObservaciones">
        <form action="{{URL::action('TesisController@SubirArchivo')}}"
              class="dropzone" id="form-subir-observaciones">
            <input type="hidden" name="tesis_id" value="{{$tesis->id}}">
            <input type="hidden" name="tipo_archivo" value="4">
            <div class="dz-message" data-dz-message><span>Arrastre la observación que desea agregar aquí</span></div>
            {{ csrf_field() }}
        </form>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="tbodyListaArchivos">
                    @foreach($tesis->archivos_tesis as $archivo)
                        <tr>
                            <td>
                                {{$archivo->nombre_archivo}}
                            </td>
                            <td>
                                <a href="{{url('/')}}/uploads/tesis/archivos/{{$tesis->id}}/{{$archivo->nombre_archivo}}" class='btn btn-success'><i class='glyphicon glyphicon-arrow-down'></i></a>
                            </td>
                            <td>
                                <a href="#" onclick="EliminarArchivo({{$archivo->id}})" class='btn btn-danger'><i class='glyphicon glyphicon-remove'></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section ('scripts')
    @if (Session::has('message'))
        <script>
            $(document).ready(function(){
                Swal({
                    title: 'Archivo',
                    text: "{{ Session::get('message') }}",
                    timer:5000
                });
            })
        </script>
    @endif
    <script>
        Dropzone.autoDiscover = false;
        var myDropzone;
        var myDropzon2;
        $(document).ready(function(){
            $('#btnAgregarArchivo').click(function(event){
                event.preventDefault();
                $('#dropzoneArchivo').removeClass('hidden');
                $('#dropzoneObservaciones').addClass('hidden');
            });
            $('#btnAgregarObservaciones').click(function(event){
                event.preventDefault();
                $('#dropzoneArchivo').addClass('hidden');
                $('#dropzoneObservaciones').removeClass('hidden');
            });

            myDropzone = new Dropzone("#form-subir-archivo",
                {
                    uploadMultiple: false,
                    paramName: "archivo", // The name that will be used to transfer the file
                    maxFilesize: 2, // MB
                    acceptedFiles: ".pdf, .doc, .docx",
                    /*                addRemoveLinks: true,
                                    dictRemoveFile: "Remover",*/
                });

            myDropzone2 = new Dropzone("#form-subir-observaciones",
                {
                    uploadMultiple: false,
                    paramName: "archivo", // The name that will be used to transfer the file
                    maxFilesize: 2, // MB
                    acceptedFiles: ".pdf, .doc, .docx",
                    /*                addRemoveLinks: true,
                                    dictRemoveFile: "Remover",*/
                });

            myDropzone.on('success', function(file, response){
                var salida = "";
                salida += "<tr>";
                    salida += "<td>";
                        salida += file.name;
                    salida += "</td>";
                    salida += "<td>";
                        salida += "<a href=\"{{url('/')}}/uploads/tesis/archivos/{{$tesis->id}}/"+ file.name +"\" class='btn btn-success'><i class='glyphicon glyphicon-arrow-down'></i></a>";
                    salida += "</td>";
                    salida += "<td>";
                        salida += "<a href='#' onclick='EliminarArchivo(" + JSON.parse(response).id + ")' class='btn btn-danger'><i class='glyphicon glyphicon-remove'></i></a>";
                    salida += "</td>";
                salida += "</tr>";

                $('#tbodyListaArchivos').append(salida);

            });



            myDropzone2.on('success', function(file, response){
                var salida = "";
                salida += "<tr>";
                    salida += "<td>";
                        salida += file.name;
                    salida += "</td>";
                    salida += "<td>";
                        salida += "<a href=\"{{url('/')}}/uploads/tesis/archivos/{{$tesis->id}}/"+ file.name +"\" class='btn btn-success'><i class='glyphicon glyphicon-arrow-down'></i></a>";
                    salida += "</td>";
                    salida += "<td>";
                        salida += "<a href='#' onclick='EliminarArchivo(" + JSON.parse(response).id + ")' class='btn btn-danger'><i class='glyphicon glyphicon-remove'></i></a>";
                    salida += "</td>";
                salida += "</tr>";

                $('#tbodyListaArchivos').append(salida);
            });
        });

        function EliminarArchivo(id){
            Swal.fire({
                title:'¿Eliminar Archivo?',
                text:'¿Está seguro que desea eliminar el archivo?',
                type:'question',
                confirmButtonText:"Aceptar",
                cancelButtonText:"Cancelar",
                showConfirmButton: true,
                showCancelButton: true,
            }).then(function(res){
                if(res.value === true){
                    $.ajax({
                        url:"{{URL::action('TesisController@EliminarArchivo',array('tesis_id'=>$tesis->id))}}/" + id,
                        data:{_token: "{{csrf_token()}}"},
                        type: 'POST',
                        success: function(result) {
                            if(result === 'ok'){
                                Swal.fire(
                                    'Archivo',
                                    'Archivo eliminado correctamente',
                                    'success'
                                ).then(function(){
                                   window.location = "{{URL::action('TesisController@show',$tesis->id)}}";
                                });
                            }else{
                                Swal.fire(
                                    'Archivo',
                                    'Ocurrió un error al Eliminar el archivo\n por favor intente de nuevo o contacte con el administrador',
                                    'warning'
                                );
                            }
                        }
                    });
                }
            });

        }
    </script>
@endsection
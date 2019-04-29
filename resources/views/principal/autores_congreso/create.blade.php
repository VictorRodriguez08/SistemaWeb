@extends ('layouts.admin')
@section ('contenido')
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm6 col-xs-12 ">
                <h3> Autores de Congreso</h3>
                @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {!!Form::Open(array('url'=>'autores_congreso', 'method'=>'POST','autocomplete'=>'off',"enctype"=>"multipart/form-data"))!!}
                    {{Form::token()}}
                <div class="col">

                    <h5>* Campo Obligatorio</h5>
                    <label> </label><label> </label>
                </div>

                    <div class="form-group">
                        <label>* Selecione CongresoCongreso</label>
                        <select name="congreso_id" class="form-control" required>
                            <option value="">--Selecione un congreso--</option>
                            @foreach($congresos as $congreso)

                                <option value="{{$congreso->id}}"> {{ $congreso->nombre}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label>* Nombre del autor 1</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">--Selecione un autor--</option>
                            @foreach($users as $user)

                                <option value="{{$user->id}}"> {{ $user->name}}{{" "}}{{$user->apellidos}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xs-12">
                        <div class="table-responsibe">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="hidden"></th>
                                    <th>Nombre</th>
                                </tr>
                                </thead>
                                <tbody id="tbodyAutoresCongreso">

                                </tbody>
                            </table>
                        </div>
                        <div id="listaUsuarios"></div>
                    </div>

                    <div id="divUsuarios">

                    </div>
                                
                    <div class="form-group{{ $errors->has('carrera') ? ' has-error' : '' }}">
                        <label for="carrera" class="control-label">Carrera <label>*</label></label>

                            <div class="">
                                <input id="carrera" type="text" class="form-control" name="carrera" value="{{ old('carrera') }}" placeholder="Carrera que estudia" required>

                                @if ($errors->has('carrera'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('carrera') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>


                    <div class="form-group{{ $errors->has('tema') ? ' has-error' : '' }}">
                        <label for="Tema" class=" control-label">Tema <label>*</label></label>

                        <div class="">
                            <input id="tema" type="text" class="form-control" name="tema" value="{{ old('tema') }}" placeholder="Digite Tema" required>

                            @if ($errors->has('tema'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tema') }}</strong>
                                </span>
                            @endif
                        </div>

                    </div>
                            

                    <div class="form-group">
                        <label>* Dias de la Semana</label>
                        <select name="dia" class="form-control" required>
                            <option value="Lunes">Lunes</option>
                            <option value="Martes">Martes</option>
                            <option value="Miercoles">Miercoles</option>
                            <option value="Jueves">Jueves</option>
                            <option value="Viernes">Viernes</option>
                            <option value="Sabado">Sabado</option>
                            <option value="Domingo">Domingo</option>
                        </select>

                    </div>

                    <div class="row">
                        <div class="form-group{{ $errors->has('url_archivo') ? ' has-error' : '' }}">
                            <label for="Tema" class="col-md-4 control-label">URL Archivo <label>*</label></label>

                            <input type="file" name="url_archivo" id="url_archivo" required>
                            <div class="col-md-8">
                                @if ($errors->has('url_archivo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url_archivo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                <div class="from-group">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
                    
                </div>

            {!!Form::close()!!}
            </div>
        </div>
@endsection

@section('scripts')

    <script>
        var lista_usuarios = [];

        $(document).ready(function() {
            $('#user_id').select2();

            $('#user_id').change(function(){
                agregar_usuario($(this).val(), $(this).find('option:selected').text());
            });
        });

        function agregar_usuario(id_usuario, nombre){
            if(usuario_existe(id_usuario) === false){
                var u = {
                    id: parseInt(id_usuario),
                    nombre:nombre
                };

                lista_usuarios.push(u);
                cargar_tabla();
            }
        }

        function cargar_tabla(){
            var datos = "";

            $('#tbodyAutoresCongreso').html("");
            $('#divUsuarios').html('');

            for(var i=0; i< lista_usuarios.length;i++){
                datos = "";
                datos += "<tr>";
                    datos += "<td>";
                        datos += "<a href='#' class='btn btn-danger' onclick='eliminar_usuario("+ i + ", event)'>Eliminar</a>";
                    datos += "</td>";
                    datos += "<td>";
                        datos += lista_usuarios[i].nombre;
                    datos += "</td>";
                datos += "</tr>";

                $('#tbodyAutoresCongreso').append(datos);

                $('#divUsuarios').append('<input type="hidden" name="usuario_id[]" value="'+ lista_usuarios[i].id +'"/>');
            }
        }

        function usuario_existe(id){
            var result=false;
            for(var i=0; i< lista_usuarios.length; i++){
                if(lista_usuarios[i].id === parseInt(id)){
                    result = true;
                }
            }
            return result;
        }

        function eliminar_usuario(indice,event ){
            event.preventDefault();

            lista_usuarios.splice(parseInt(indice),1);
            cargar_tabla();
        }
    </script>
@endsection



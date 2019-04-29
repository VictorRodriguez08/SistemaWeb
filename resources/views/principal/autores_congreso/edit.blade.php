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

            {!!Form::Open(array('url'=>['autores_congreso',$autor_congreso->id],'method'=>'PATCH','autocomplete'=>'off',"enctype"=>"multipart/form-data"))!!}
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
                        @foreach($autores_congreso as $autor)
                            <option value="{{$congreso->id}}" {{$autor['congreso_id'] == $congreso->id ? "selected" : ""}}> {{ $congreso->nombre}}</option>
                        @endforeach

                    @endforeach
                </select>
            </div>



            <div class="form-group">
                <label>* Nombre del autor 1</label>
                <select name="user_id" id="user_id" class="form-control">
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
                            <th>Nombre</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyAutoresCongreso">
                            @php
                                $i = 0;
                            @endphp

                            @foreach($autores_congreso as $autor)
                                <tr>
                                    <td><a href='#' class='btn btn-danger' onclick='eliminar_usuario("{{$i++}}", event)'>Eliminar</a></td>
                                    <td>{{$autor['nombre']}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div id="listaUsuarios"></div>
            </div>

            <div id="divUsuarios">
                @foreach($autores_congreso as $autor)
                        <input type="hidden" value="{{$autor['id']}}" name="usuario_id[]" />
                @endforeach
            </div>

            <div class="form-group{{ $errors->has('carrera') ? ' has-error' : '' }}">
                <label for="carrera" class="control-label">Carrera <label>*</label></label>

                <div class="">
                    <input id="carrera" type="text" class="form-control" name="carrera" value="{{old('carrera') != null ? old('carrera') :$autor_congreso->carrera}}" placeholder="Carrera que estudia" required >

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
                    <input id="tema" type="text" class="form-control" name="tema" value="{{old('tema') != null ? old('tema') :$autor_congreso->tema}}" placeholder="Digite Tema" required>

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
                    <option value="Lunes" {{(old('dia')!= null ? old('dia') :$autor_congreso->dia )== "Lunes" ? "selected": ""}}>Lunes</option>
                    <option value="Martes" {{(old('dia')!= null ? old('dia') :$autor_congreso->dia )== "Martes" ? "selected": ""}}>Martes</option>
                    <option value="Miercoles" {{(old('dia')!= null ? old('dia') :$autor_congreso->dia )== "Miercoles" ? "selected": ""}}>Miercoles</option>
                    <option value="Jueves" {{(old('dia')!= null ? old('dia') :$autor_congreso->dia )== "Jueves" ? "selected": ""}}>Jueves</option>
                    <option value="Viernes" {{(old('dia')!= null ? old('dia') :$autor_congreso->dia )== "Viernes" ? "selected": ""}}>Viernes</option>
                    <option value="Sabado" {{(old('dia')!= null ? old('dia') :$autor_congreso->dia )== "Sabado" ? "selected": ""}}>Sabado</option>
                    <option value="Domingo" {{(old('dia')!= null ? old('dia') :$autor_congreso->dia )== "Domingo" ? "selected": ""}}>Domingo</option>
                </select>

            </div>


            <div class="row">
                <div class="form-group{{ $errors->has('url_archivo') ? ' has-error' : '' }}">
                    <label for="Tema" class="col-md-4 control-label">URL Archivo <label>*</label></label>

                    <input type="file" name="url_archivo" id="url_archivo">
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
                <a class="btn btn-primary" href="#" id="btnGuardar">Guardar</a>
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

            $('#btnGuardar').click(function(event){
                event.preventDefault();

               if(lista_usuarios.length === 0)
               {
                   Swal.fire(
                       'Editar Autores de Congreso',
                       'Debe agregar por lo menos un autor a la lista de autores',
                       'error'
                   );

                   return false;
               }

               $('form').submit();
            });

            $('#user_id').change(function(){
                agregar_usuario($(this).val(), $(this).find('option:selected').text());
            });

            @foreach ($autores_congreso as $autor)
                lista_usuarios.push({
                    'id': '{{ $autor['id']}}',
                    'nombre':'{{$autor['nombre']}}'
                });
            @endforeach
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
                if(parseInt(lista_usuarios[i].id) === parseInt(id)){
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



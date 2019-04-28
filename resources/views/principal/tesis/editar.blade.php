@php
    $total_alumnos = 0;
    $total_asesores = 0;
    $total_jurados = 0;
    $correlativo = 0;
@endphp

@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        {!!Form::model($tesis,['method'=>'PATCH','route'=>['tesis.update',$tesis->id]])!!}
        {!! Form::hidden('urlBuscarUsuario', url('administracion/usuario/buscar'),array('id' => 'urlBuscarUsuario')) !!}
        {{Form::token()}}
        <input type="hidden" value="{{$ESTADOS_TESIS->PERFIL}}" id="PERFIL">
        <input type="hidden" value="{{$ESTADOS_TESIS->ANTEPROYECTO}}" id="ANTEPROYECTO">
        <input type="hidden" value="{{$ESTADOS_TESIS->TESIS}}" id="TESIS">

        <div class="col-lg-6 col-md-6 col-sm6 col-xs-12 ">
            <h3> Editar Tesis</h3>
            @if (count($errors)>0 || isset($excepcion))
                <div class="alert alert-danger">
                    @if(count($errors)>0)
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>

                    @endif

                    @if(isset($excepion))
                        {{$excepcion}}
                    @endif
                </div>
            @endif


            <div class="row">
                <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                    <label for="titulo" class="col-md-6 control-label">Título</label>
                    <div class="col-md-6">
                        <input id="titulo" type="text" class="form-control" name="titulo" value="{{$tesis->titulo }}">
                        @if ($errors->has('titulo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('titulo') }}</strong>
                            </span>
                        @endif
                    </div>
                    <br>
                    <br>

                </div>
            </div>
            <div class="row">
                <div class="form-group{{ $errors->has('carrera') ? ' has-error' : '' }}">
                    <label for="carrera" class="col-md-6 control-label">Carrera</label>
                    <div class="col-md-6">
                        <input type="text" name="carrera" id="carrera" class="form-control" required value="{{$tesis->carrera}}"/>
                        @if ($errors->has('titulo'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('carrera') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <br>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="form-group{{ $errors->has('carrera') ? ' has-error' : '' }}">
                    <label for="facultad" class="col-md-6 control-label">Facultad</label>
                    <div class="col-md-6">
                        <input type="text" name="facultad" id="facultad" class="form-control" required value="{{$tesis->facultad}}"/>
                        @if ($errors->has('facultad'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('facultad') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <br>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="form-group{{ $errors->has('estado_id') ? ' has-error' : '' }}">
                    <label for="estado_id" class="col-md-6 control-label">Estado</label>
                    <div class="col-md-6">
                        <select name="estado_id" id="estado_id" class="form-control">
                            <option value="">seleccione un estado</option>
                            @foreach($estados as $estado)
                                <option value="{{$estado->id}}" {{ $tesis->estado_id == $estado->id ? 'selected="selected"' : '' }}>{{$estado->estado}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('estado_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('estado_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <br>
                    <br>

                </div>
            </div>
            <div class="row">
                <div class="form-group{{ $errors->has('fecha_ini') ? ' has-error' : '' }}">
                    <label for="fecha_ini" class="col-md-6 control-label">Fecha Inicio</label>
                    <div class="col-md-6">
                        <input id="fecha_ini" class="datepicker" name="fecha_ini" value="{{ date('d-m-Y',strtotime($tesis->fecha_ini)) }}">

                        @if ($errors->has('fecha_ini'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fecha_ini') }}</strong>
                            </span>
                        @endif
                    </div>
                    <br>
                    <br>

                </div>
            </div>
            <div class="row">
                <div class="form-group{{ $errors->has('fecha_fin') ? ' has-error' : '' }}">
                    <label for="fecha_fin" class="col-md-6 control-label">Fecha fin</label>
                    <div class="col-md-6">
                        <input id="fecha_fin" class="datepicker" name="fecha_fin" value="{{ $tesis->fecha_fin != null ? date('d-m-Y',strtotime($tesis->fecha_fin )) : ""}}">

                        @if ($errors->has('fecha_fin'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fecha_fin') }}</strong>
                            </span>
                        @endif
                    </div>
                    <br>
                    <br>

                </div>
            </div>
            <div class="col-sm-12">
                <h4>Ingrese los usuarios que pertenecen a la Tesis</h4>
            </div>
            <div class="col-sm-12 col-md-4">
                <a href="#" id="btnBuscarUsuario" class="btn btn-primary">Agregar Alumnos</a>
            </div>
            <div class="col-sm-12 col-md-4">
                <a href="#" id="btnBuscarJurado" class="btn btn-primary">Agregar Asesor y Jurado</a>
            </div>


        </div>
        <div class="col-xs-12">
            <div class="table-responsibe">
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th class="hidden"></th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Jurado</th>
                        <th>Asesor</th>
                        <th>Alumno</th>
                        <th>Cargo</th>
                    </tr>
                    </thead>
                    <tbody id="tbodyUsuariosTesis">
                    @foreach($tesis->usuario_tesis as $u)
                        <tr>
                            <td>
                                <a href='#' class='btn btn-danger' onclick='eliminar_usuario("{{$u->user->id}}","{{$u->rol}}","{{$u->cargo}}" ,this, event)'>Eliminar</a>
                            </td>
                            <td class="hidden">{{$u->user->id}}</td>
                            <td>{{$u->user->name}}</td>
                            <td>{{$u->user->apellidos}}</td>
                            <td>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios{{++$correlativo}}" value="1" {{$u->rol == 3 ? "checked" : ""}} disabled>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios{{$correlativo}}" value="2" {{$u->rol == 2 ? "checked" : ""}} disabled>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios{{$correlativo}}" value="3" {{$u->rol == 1 ? "checked" : ""}} disabled>
                                    </label>
                                </div>
                            </td>
                            <td>
                                @if($u->rol == 3)
                                    @if($u->cargo == 0)
                                        Presidente
                                    @elseif($u->cargo == 1)
                                        Primer Vocal
                                    @elseif($u->cargo == 2)
                                        Segundo Vocal
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div id="listaUsuarios">
                @foreach($tesis->usuario_tesis as $u)
                    <input name="usuario_id[]" type="hidden" value="{{$u->user->id}}_{{$u->rol}}_{{$u->cargo}}" />
                    @php
                        switch($u->rol){
                            case 1:
                            ++$total_alumnos;
                            break;
                            case 2:
                            ++$total_asesores;
                            break;
                            case 3:
                            ++$total_jurados;
                            break;
                        }
                    @endphp
                @endforeach
            </div>
            <div class="from-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a href="{{URL::action('TesisController@index')}}" class="btn btn-danger" type="reset">Cancelar</a>

            </div>
        </div>
        {!!Form::close()!!}
    </div>

    @include('principal.tesis.modal')
@endsection

@section ('scripts')
    <script>
        let SOLO_PERFIL = true;
    </script>
    <script src="{{asset('js/tesis.js')}}"></script>
    <script>
        maximo_alumnos = parseInt("{{$total_alumnos}}");
        maximo_asesores = parseInt("{{$total_asesores}}");
        maximo_jurados = parseInt("{{$total_jurados}}");
        $(document).ready(function(){
           SOLO_PERFIL = "{{$tesis->estado_id == 1 ? 'true': 'false'}}";
           SOLO_PERFIL = SOLO_PERFIL === "true";
           $('#estado_id').change(function(){
              if(parseInt($(this).val()) === 1){
                SOLO_PERFIL = true;
              } else{
                  SOLO_PERFIL = false;
              }
           });
           correlativo = parseInt("{{++$correlativo}}");
        });
    </script>
@endsection

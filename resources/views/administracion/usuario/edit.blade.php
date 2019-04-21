@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-xs-12">
			<h3>Editar Usuario: {{ $usuario->name}}</h3>
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

			{!!Form::model($usuario,['method'=>'PATCH','route'=>['administracion.usuario.update',$usuario->id]])!!}
            {{Form::token()}}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$usuario->name}}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>

                        </div>


						<div class="form-group{{ $errors->has('apellidos') ? ' has-error' : '' }}">
                            <label for="apellidos" class="col-md-4 control-label">Apellidos</label>

                            <div class="col-md-6">
                                <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{ $usuario->apellidos }}">

                                @if ($errors->has('apellidos'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apellidos') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo Electronico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $usuario->email}}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>
                            
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkCambiarClave" name="cambiarClave" value="true"> Cambiar Contraseña
                            </label>
                        </div>
                        <div id="divClave" class="hidden">
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <br>
                                <br>

                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <br>
                                <br>

                            </div>

                        </div>


                        <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                            <label for="direccion" class="col-md-4 control-label">Direccion</label>

                            <div class="col-md-6">
                                <input id="direccion" type="text" class="form-control" name="direccion" value="{{$usuario->direccion}}">
                                @if ($errors->has('direccion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                            <label for="titulo" class="col-md-4 control-label">Titulo</label>

                            <div class="col-md-6">
                                <input id="titulo" type="text" class="form-control" name="titulo" value="{{$usuario->titulo}}">
                                @if ($errors->has('titulo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('titulo') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('otros_estudios') ? ' has-error' : '' }}">
                            <label for="otros_estudios" class="col-md-4 control-label">Otros Estudios (Llenar este campo si no es alumno)</label>

                            <div class="col-md-6">
                                <input data-role="tagsinput" id="otros_estudios" type="text" class="form-control" name="otros_estudios" value="{{$usuario->otros_estudios}}">

                                @if ($errors->has('otros_estudios'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('otros_estudios') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('fecha_nac') ? ' has-error' : '' }}">
                            <label for="fecha_nac" class="col-md-4 control-label">Fecha de Nacimiento</label>

                            <div class="col-md-6">
                                <input id="fecha_nac" type="text" class="form-control" name="fecha_nac" value="{{ $usuario->fecha_nac}}">

                                @if ($errors->has('fecha_nac'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha_nac') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('dui') ? ' has-error' : '' }}">
                            <label for="dui" class="col-md-4 control-label">DUI</label>

                            <div class="col-md-6">
                                <input id="dui" type="text" class="form-control" name="dui" value="{{$usuario->dui}}">

                                @if ($errors->has('dui'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dui') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('telefonos') ? ' has-error' : '' }}">
                            <label for="telefonos" class="col-md-4 control-label">Telefonos</label>

                            <div class="col-md-6">
                                <input id="telefonos" type="text" class="form-control" name="telefonos" value="{{$usuario->telefonos}}">

                                @if ($errors->has('telefonos'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telefonos') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>
                            
                        </div>

                       	<div class="form-group{{ $errors->has('otros_email') ? ' has-error' : '' }}">
                            <label for="otros_email" class="col-md-4 control-label">Otros Emails</label>

                            <div class="col-md-6">
                                <input id="otros_email" type="text" class="form-control" name="otros_email" value="{{$usuario->otros_email}}">

                                @if ($errors->has('otros_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('otros_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>
                            
                        </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label for="select_rol">Rol</label>
                        </div>
                        <div class="col-md-6">
                            <select id="select_rol" name="role_id" class="form-control" required>
                                <option value="">--Seleccione un Rol--</option>
                                @foreach($roles as $rol)
                                    <option value="{{$rol->id}}" {{ $rol->id == $usuario->primer_rol()->role_id ? "selected":"" }}>{{$rol->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br><br><br>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label for="select_tipo">Tipo de Usuario</label>
                        </div>
                        <div class="col-md-6">
                            <select id="select_tipo" name="tipo_usuario" class="form-control" required>
                                <option value="">--Seleccione un Rol--</option>
                                <option value="0" {{$usuario->tipo_usuario == 0 ? "selected": "" }}>Alumno</option>
                                <option value="1" {{$usuario->tipo_usuario == 1 ? "selected": "" }}>Jurado o Asesor</option>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label for="select_estado">Estado</label>
                        </div>
                        <div class="col-md-6">
                            <select id="select_estado" name="estado_id" class="form-control" required>
                                <option value="">--Seleccione un Estado--</option>
                                <option value="1"  {{ $usuario->estado == 1 ? "selected":"" }}>Activo</option>
                                <option value="0"  {{ $usuario->estado == 0 ? "selected":"" }}>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <br><br><br>
                    <div class="form-group">
                        <a href="#" onclick="confirmar()" class="btn btn-primary">Guardar</a>

                        <a href="{{URL::action('UsuarioController@index')}}" class="btn btn-danger" type="reset">Cancelar</a>
                        
                    </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#chkCambiarClave').change(function(){
                if($(this).is(':checked')){
                    $('#divClave').removeClass('hidden')
                }else{
                    $('#divClave').addClass('hidden')
                }
            });
           
         });
    </script>
    
    <script >


        function confirmar(Form)
            {
                                Swal.fire({
              title: '¿Desea Actualizar el Registro?',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Cancelar',
              confirmButtonText: 'Confirmar'
              
              
            }).then((result) => {
              if (result.value) {
                $('Form').submit();
              }
            })
            

        }
    
    </script>

@endsection
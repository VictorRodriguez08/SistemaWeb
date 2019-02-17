@extends ('layouts.admin')
@section ('contenido')
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm6 col-xs-12 ">
				<h3> Nuevo Usuario</h3>
				@if(count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
				@endif

				{!!Form::Open(array('url'=>'administracion/usuario', 'method'=>'POST','autocomplete'=>'off'))!!}
					{{Form::token()}}
                        <div class="row">
                        
						<div class="row" >
							 <div class="col-md-6 control-label">
                                <h5 class="col-md-12">  * Campo Obligatorio</h5>
                                <label> </label><label> </label>
                            </div>
                        	</div>

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <label for="name" class="col-md-6 control-label">Nombre  <label>*</label></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>

                        </div>
                    </div>

                    <div class="row">


						<div class="form-group{{ $errors->has('apellidos') ? ' has-error' : '' }}">
                            <label for="apellidos" class="col-md-6 control-label">Apellidos  <label>*</label></label>

                            <div class="col-md-6">
                                <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{ old('apellidos') }}" placeholder="Apellidos">

                                @if ($errors->has('apellidos'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apellidos') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>
                            
                        </div>
                        </div>

                        <div class="row">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-6 control-label">Correo Electronico  <label>*</label></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="ejemplo@ejemplo.com">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>
                            
                        </div>
                        </div>

                        <div class="row">

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-6 control-label">Contraseña <label>*</label></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Digite contraseña">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>
                            
                        </div>
                        </div>

                        <div class="row">

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-6 control-label">Confirmar Contraseña <label>*</label></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Digite contraseña">

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

                        <div class="row">

                        <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                            <label for="direccion" class="col-md-6 control-label">Direccion <label>*</label></label>

                            <div class="col-md-6">
                                <input id="direccion" type="text" class="form-control" name="direccion" value="{{old('direccion')}}" placeholder="Digite dirección">
                                @if ($errors->has('direccion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>
                            
                        </div>
                        </div>

                        <div class="row">
                        <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                            <label for="titulo" class="col-md-6 control-label">Titulo <label>*</label></label>

                            <div class="col-md-6">
                                <input id="titulo" type="text" class="form-control" name="titulo" value="{{old('titulo')}}" placeholder="Digite nombre del titulo ">
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
                        <div class="form-group{{ $errors->has('otros_estudios') ? ' has-error' : '' }}">
                            <label for="otros_estudios" class="col-md-6 control-label">Otros Estudios</label>

                            <div class="col-md-6">
                                <input id="otros_estudios" type="text" class="form-control" name="otros_estudios" value="{{ old('otros_estudios') }}" placeholder="Otros estudios">

                                @if ($errors->has('otros_estudios'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('otros_estudios') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>
                            
                        </div>
                        </div>

                        <div class="row">
                        <div class="form-group{{ $errors->has('fecha_nac') ? ' has-error' : '' }}">
                            <label for="fecha_nac" class="col-md-6 control-label">Fecha de Nacimiento  <label>*</label></label>

                            <div class="col-md-6">
                                <input id="fecha_nac" type="text" class="form-control" name="fecha_nac" value="{{ old('fecha_nac') }}" placeholder="Digite fecha DD-MM-AAAA">

                                @if ($errors->has('fecha_nac'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha_nac') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>
                            
                        </div>
                        </div>


                        <div class="row">
                        <div class="form-group{{ $errors->has('dui') ? ' has-error' : '' }}">
                            <label for="dui" class="col-md-6 control-label">DUI  <label>*</label></label>

                            <div class="col-md-6">
                                <input id="dui" type="text" class="form-control" name="dui" value="{{ old('dui') }}" placeholder="Digite DUI">

                                @if ($errors->has('dui'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dui') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>
                            
                        </div>
                        </div>

                        <div class="row">
                        <div class="form-group{{ $errors->has('telefonos') ? ' has-error' : '' }}">
                            <label for="telefonos" class="col-md-6 control-label">Telefonos  <label>*</label></label>

                            <div class="col-md-6">
                                <input id="telefonos" type="text" class="form-control" name="telefonos" value="{{ old('telefonos') }}" placeholder="Digite Telefonos">

                                @if ($errors->has('telefonos'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telefonos') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>
                            
                        </div>
                        </div>

                        <div class="row">
                       	<div class="form-group{{ $errors->has('otros_email') ? ' has-error' : '' }}">
                            <label for="otros_email" class="col-md-6 control-label">Otros Emails</label>

                            <div class="col-md-6">
                                <input id="otros_email" type="text" class="form-control" name="otros_email" value="{{ old('otros_email') }}" placeholder="Digite otros si desea">

                                @if ($errors->has('otros_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('otros_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <br>
                            
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


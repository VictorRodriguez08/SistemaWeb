@extends ('layouts.admin')
@section ('contenido')

		<div class="row">
            {!!Form::Open(array('url'=>'tesis', 'method'=>'POST','autocomplete'=>'off'))!!}
            {!! Form::hidden('urlBuscarUsuario', url('administracion/usuario/buscar'),array('id' => 'urlBuscarUsuario')) !!}
            {{Form::token()}}
            <input type="hidden" value="{{$ESTADOS_TESIS->PERFIL}}" id="PERFIL">
            <input type="hidden" value="{{$ESTADOS_TESIS->ANTEPROYECTO}}" id="ANTEPROYECTO">
            <input type="hidden" value="{{$ESTADOS_TESIS->TESIS}}" id="TESIS">

			<div class="col-lg-6 col-md-6 col-sm6 col-xs-12 ">
				<h3> Nueva Tesis</h3>
				@if(count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
				@endif


                    <div class="row">
                        <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                            <label for="titulo" class="col-md-6 control-label">Título</label>
                            <div class="col-md-6">
                                <input id="titulo" type="text" class="form-control" name="titulo" value="{{ old('titulo') }}">

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
                        <div class="form-group{{ $errors->has('estado_id') ? ' has-error' : '' }}">
                            <label for="estado_id" class="col-md-6 control-label">Estado</label>
                            <div class="col-md-6">
                                <select name="estado_id" id="estado_id" class="form-control">
                                    <option value="">seleccione un estado</option>
                                    @foreach($estados as $estado)
                                        <option value="{{$estado->id}}">{{$estado->estado}}</option>
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
                                <input id="fecha_ini" class="datepicker" name="fecha_ini" value="{{ old('fecha_ini') }}">

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
                                <input id="fecha_fin" class="datepicker" name="fecha_fin" value="{{ old('fecha_fin') }}">

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
                    <div class="col-sm-12 col-md-10">
                        <h4>Ingrese los usuarios que pertenecen a la Tesis</h4>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <a href="#" id="btnBuscarUsuario" class="btn btn-primary">Agregar</a>
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
                        </tr>
                        </thead>
                        <tbody id="tbodyUsuariosTesis">

                        </tbody>
                    </table>
                </div>
                <div id="listaUsuarios"></div>
                <div class="from-group">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <a href="{{URL::action('TesisController@index')}}" class="btn btn-danger" type="reset">Cancelar</a>

                </div>
            </div>
            {!!Form::close()!!}
        </div>

        @include('principal.tesis.modal')
@endsection


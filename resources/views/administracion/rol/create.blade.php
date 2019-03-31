@extends ('layouts.admin')
@section ('contenido')
<div class="card-body">
	@if($errors->all())
		<div class="alert alert-danger" role="alert">
			{{ Html::ul($errors->all()) }}
		</div>
	@endif

		{!!Form::Open(array('url'=>'administracion/rol', 'method'=>'POST','autocomplete'=>'off'))!!}

	<div class="row">
		<div class="col-sm-12 col-md-6">
			<div class="form-group">
				{{ Form::label('rol', 'Rol') }}
				{{ Form::text('rol', $rol->name, array('class' => 'form-control','required'=>true)) }}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<h6 class="text-center">Por favor seleccione los permisos a los que tendrá acceso el rol</h6>
		</div>
		@foreach($menus_disponibles as $menu)
			<div class="col-sm-12 col-md-6">
				<div class="card">
					<div class="card-body">
						<h6>{{$menu}}</h6>
						@foreach($operaciones_crud as $operacion)
							@php
								$seleccionado = strpos($rol->permisos,strtolower($operacion) . '-' . strtolower($menu));
							@endphp
							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="{{strtolower($menu . '[]')}}" value="{{strtolower($operacion)}}" {{$seleccionado?"checked":""}}> {{$operacion}}
									<span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
								</label>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		@endforeach
	</div>

	<div class="row">
		<div class="col-sm-12 text-right">
			{{ Form::submit('Guardar', array('class' => 'btn btn-primary btn-raised btn-lg')) }}
		</div>
	</div>

	{{ Form::close() }}
</div>

@endsection

@section ('scripts')

@endsection

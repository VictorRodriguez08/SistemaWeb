@php
	$puede_editar = false;
    $puede_eliminar = false;
    $puede_mostrar = false;
    if (Gate::allows('actualizar-seguridad')) {
        $puede_editar = true;
    }
    if (Gate::allows('eliminar-seguridad')) {
        $puede_eliminar = true;
    }

     if (Gate::allows('listar-log')) {
        $puede_mostrar = true;
    }
@endphp




@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		@can('listar-log')
		@include('registro.log.search')
		@endcan
	</div>
</div>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
		<div class="form-group">
			<label>Archivos Log</label>

		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<tr>
						<th width="20px">Id</th>
						<th width="100px">Nombre de Tabla</th>
						<th width="200px">Nombre del usuario</th>
						<th width="200px">Accion realizada</th>
						<th width="200px">Fecha de Creacion</th>
						<th width="200px">Email</th>
						<th colspan="3">&nbsp</th>
						<th>Opciones</th>
						
					</tr>
				</thead>
				<tbody>
				@foreach ($logs as $l)
					<tr>
						<td>{{ $l->id}}</td>
						<td>{{ $l->nombre_tabla}}</td>
						<td>{{ $l->user_n}}{{" "}}{{ $l->user_a}}</td>
						<td>{{ $l->accion_realizada}}</td>
						<td>{{ $l->created_at}}</td>
						<td>{{ $l->email}}</td>
						<th colspan="3">&nbsp</th>
						<td>
							@if($puede_mostrar)
							<a href="{{URL::action('LogController@show',$l->id)}}"><button class="btn btn-info">Ver</button></a>
							@endif
						</td>						 
					</tr>
					
				@endforeach
				</tbody>
				
			</table>
			
									
        
			
		</div>
		{{$logs->render()}}
	</div>
</div>
@endsection

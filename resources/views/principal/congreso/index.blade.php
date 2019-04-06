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

     if (Gate::allows('listar-seguridad')) {
        $puede_mostrar = true;
    }
@endphp


@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		@can('crear-seguridad', auth()->user())
		<h3>Listado de Congresos <a href="congreso/create"> <button class="btn btn-success">Nuevo</button></a></h3>
		@endcan
		@include('principal.congreso.search')
	</div>
</div>
	<div class="col-sm-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Fecha Inicio</th>
						<th>Fecha Entrega de Trabajos</th>
						<th>Fecha Fin</th>
						<th colspan="3">&nbsp</th>
						<th>Opciones</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($congresos as $c)
						<tr>
							<td>{{ $c->nombre}}</td>
							<td>{{ date('d-m-Y',strtotime($c->fecha_ini))}}</td>
							<td>{{ date('d-m-Y',strtotime($c->fecha_entrega))}}</td>
							<td>{{ date('d-m-Y',strtotime($c->fecha_fin))}}</td>
							<th colspan="3">&nbsp</th>
							<td>
								@if($puede_editar)
								<a href="{{URL::action('CongresoController@edit',$c->id)}}"><button class="btn btn-warning">Editar</button></a>
								@endif
							</td>
							<td>
								<a href="" data-target="#modal-delete-{{$c->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('principal.congreso.modal_eliminar')
					@endforeach
				</tbody>
			</table>
		</div>
		{{$congresos->render()}}
	</div>
	
@endsection

@section ('scripts')
	@if (Session::has('message'))
		<script>
			$(document).ready(function(){
				Swal({
					title: 'Tesis',
					text: "{{ Session::get('message') }}",
					timer:5000
				});
			})
		</script>
	@endif
	<script src="{{asset('js/tesis_index.js')}}"></script>
@endsection

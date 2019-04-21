@php
	$puede_editar = false;
    $puede_eliminar = false;
    $puede_mostrar = false;
    if (Gate::allows('actualizar-tesis')) {
        $puede_editar = true;
    }
    if (Gate::allows('eliminar-tesis')) {
        $puede_eliminar = true;
    }

     if (Gate::allows('listar-tesis')) {
        $puede_mostrar = true;
    }
@endphp


@extends ('layouts.admin')
@section ('contenido')
	<div class="col-sm-12">
		@can('crear-tesis', auth()->user())
		<h3>Listado de Tesis <a href="tesis/create"> <button class="btn btn-success">Nuevo</button></a></h3>
		@endcan
	</div>
	<input type="hidden" value="{{url('tesis/GetUsuariosTesis')}}" id="urlListarUsuarios">
	<div class="col-sm-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<tr>
						<th>Titulo</th>
						<th>Estado</th>
						<th>Fecha Inicio</th>
						<th>Fecha Fin</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tesis as $t)
						<tr>
							<td>{{ $t->titulo}}</td>
							<td>{{ $t->estado}}</td>
							<td>{{ date('d-m-Y',strtotime($t->fecha_ini))}}</td>
							<td>{{ $t->fecha_fin!= null ? date('d-m-Y',strtotime($t->fecha_fin)) : ""}}</td>
							<td>
								@if($puede_mostrar)
								<a href="{{URL::action('TesisController@show',$t->id)}}" class="btn btn-default">Detalles</a>
								@endif
							</td>
							<td>
								@if($puede_mostrar)
									<a href="#" onclick="cartas_avance('{{URL::action('TesisController@generar_cartas',$t->id)}}',event)" class="btn btn-default">Cartas de avance</a>
								@endif
							</td>
							<td>
								@if($puede_mostrar)
								<a href="#" class="btn btn-info" onclick="ver_usuarios_tesis({{$t->id}}, event)">Ver Usuarios</a>
								@endif
							</td>
							<td>
								@if($puede_editar)
								<a href="{{URL::action('TesisController@edit',$t->id)}}"><button class="btn btn-warning">Editar</button></a>
								@endif
							</td>
							<td>
								@if($puede_eliminar)
								<a href="" data-target="#modal-delete-{{$t->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
								@endif
							</td>
						</tr>
						@include('principal.tesis.modal_eliminar')
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@include('principal.tesis.modal_lista_usuarios')
	
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

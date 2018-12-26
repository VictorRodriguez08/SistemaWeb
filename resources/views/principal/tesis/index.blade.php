@extends ('layouts.admin')
@section ('contenido')
	<div class="col-sm-12">
		<h3>Listado de Tesis <a href="tesis/create"> <button class="btn btn-success">Nuevo</button></a></h3>
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
					</tr>
				</thead>
				<tbody>
					@foreach ($tesis as $t)
						<tr>
							<td>{{ $t->titulo}}</td>
							<td>{{ $t->estado->estado}}</td>
							<td>{{ date('d-m-Y',strtotime($t->fecha_ini))}}</td>
							<td>{{ date('d-m-Y',strtotime($t->fecha_fin))}}</td>
							<td>
								<a href="#" class="btn btn-info" onclick="ver_usuarios_tesis({{$t->id}}, event)">Ver Usuarios</a>
							</td>
							<td>
								<a href="{{URL::action('TesisController@edit',$t->id)}}"><button class="btn btn-warning">Editar</button></a>
							</td>
							<td>
								<a href="" data-target="#modal-delete-{{$t->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
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
@endsection

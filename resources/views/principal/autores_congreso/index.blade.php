@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Autores de Congresos <a href="autores_congreso/create"> <button class="btn btn-success">Nuevo</button></a></h3>
		@include('principal.autores_congreso.search')
	</div>
</div>

<input type="hidden" value="{{url('autores_congreso/GetAutoresCongreso')}}" id="urlListarUsuarios">


	<div class="col-sm-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<tr>
						<th>Congreso</th>
						<th>Carrera</th>
						<th>Tema</th>
						<th>Dia</th>
						<th></th>
						<th>Opciones</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($autores_congresos as $ac)
						<tr>
							<td>{{ $ac->congreso->nombre}}</td>
							<td>{{ $ac->carrera}}</td>
							<td>{{ $ac->tema}}</td>
							<td>{{ $ac->dia}}</td>
							<th>
								<a href="#" class="btn btn-default" onclick="ver_usuarios({{$ac->id}},event)">Ver Autores</a>
							</th>
							<td>
								<a href="{{URL::action('AutoresCongresoController@edit',$ac->id)}}"><button class="btn btn-warning">Editar</button></a>
							</td>
							<td>
								<a href="" data-target="#modal-delete-{{$ac->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('principal.autores_congreso.modal_eliminar')
					@endforeach
				</tbody>
			</table>
		</div>
		{{$autores_congresos->render()}}
	</div>

	@include('principal.autores_congreso.modal_lista_usuarios')
	
@endsection

@section ('scripts')
	@if (Session::has('message'))
		<script>
			$(document).ready(function(){
				Swal({
					title: 'Autores Congreso',
					text: "{{ Session::get('message') }}",
					timer:5000
				});
			})
		</script>
	@endif
	<script src="{{asset('js/autor_congreso_index.js')}}"></script>
@endsection

@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Autores de Congresos <a href="autores_congreso/create"> <button class="btn btn-success">Nuevo</button></a></h3>
		@include('principal.autores_congreso.search')
	</div>
</div>
	<div class="col-sm-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre de Autor</th>
						<th>Congreso</th>
						<th>Carrera</th>
						<th>Tema</th>
						<th>Dia</th>
						<th colspan="3">&nbsp</th>
						<th>Opciones</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($autores_congresos as $ac)
						<tr>
							<td>{{$ac->id}}</td>
							<td>{{ $ac->user_n}}{{" "}}{{ $ac->user_a}}{{",  "}}{{ $ac->user_n1}}{{" "}}{{ $ac->user_a1}}{{",  "}}{{ $ac->user_n3}}{{" "}}{{ $ac->user_a3}}</td>
							<td>{{ $ac->con}}</td>
							<td>{{ $ac->carrera}}</td>
							<td>{{ $ac->tema}}</td>
							<td>{{ $ac->dia}}</td>
							<th colspan="3">&nbsp</th>
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
	<script src="{{asset('js/tesis_index.js')}}"></script>
@endsection

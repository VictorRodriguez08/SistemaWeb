@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Usuarios <a href="usuario/create"> <button class="btn btn-success">Nuevo</button></a></h3>
		@include('administracion.usuario.search')
	</div>
	<input type="hidden" value="{{url('usuario/GetUsuarios')}}" id="urlListarUsuario">
</div>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<tr>
						<th width="20px">Id</th>
						<th width="100px">Nombres</th>
						<th width="100px">Apelidos</th>
						<th width="200px">Email</th>
						<th colspan="3">&nbsp</th>
						<th>Opciones</th>
						<th></th>
						<th></th>
					</tr>
				</thead>


				<tbody>
				@foreach ($usuarios as $u)
					<tr>
						<td>{{ $u->id}}</td>
						<td>{{ $u->name}}</td>
						<td>{{ $u->apellidos}}</td>
						<td>{{ $u->email}}</td>
						<th colspan="3">&nbsp</th>
						<td>
							
							<a href="#" data-target="#modal_lista_usuarios-delete-{{$u->id}}" data-toggle="modal" title="Mostrar">
								<button type="button" class="btn btn-primary btn-sm">Mostrar</button>
							</a>
						</td>
						<td>
							<a href="{{URL::action('UsuarioController@edit',$u->id)}}"><button class="btn btn-warning">Editar</button></a>
						</td>
						<td>
							<a href="" data-target="#modal-delete-{{$u->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('administracion.usuario.modal')
					@include('administracion.usuario.modal_lista_usuarios')
				@endforeach
				</tbody>
				
			</table>
			
		</div>
		{{$usuarios->render()}}
	</div>
</div>


@endsection

@section ('scripts')
	@if (Session::has('message'))
		<script>
			$(document).ready(function(){
				Swal({
					title: 'Usuarios',
					text: "{{ Session::get('message') }}",
					timer:5000
				});
			})
		</script>
	@endif
	<script src="{{asset('js/usuario_index.js')}}"></script>
@endsection

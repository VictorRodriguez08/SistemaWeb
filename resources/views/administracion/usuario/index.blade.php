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
	<div class="col-sm-12">
		@can('crear-seguridad', auth()->user())
		<h3>Listado de Usuarios <a href="usuario/create"> <button class="btn btn-success">Nuevo</button></a></h3>
		@endcan
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
						<th>Id</th>
						<th >Nombres</th>
						<th >Apelidos</th>
						<th>Email</th>
						
						<th class="text-center">Opciones</th>
						
					</tr>
				</thead>


				<tbody>
				@foreach ($usuarios as $u)
					<tr>
						<td>{{ $u->id}}</td>
						<td>{{ $u->name}}</td>
						<td>{{ $u->apellidos}}</td>
						<td>{{ $u->email}}</td>
						<td style="width: 221px">
							@if($puede_mostrar)
							<a href="#" data-target="#modal_lista_usuarios-delete-{{$u->id}}" data-toggle="modal" title="Mostrar">
								<button type="button" class="btn btn-primary btn-sm">Mostrar</button>
							</a>
							@endif

							@if($puede_editar)
							
							<a href="{{URL::action('UsuarioController@edit',$u->id)}}"><button class="btn btn-warning">Editar</button></a>							
							@endif	

							@if($puede_eliminar && count($u->usuario_tesis) == 0 && count($u->autor_congreso) == 0)
							<a href="" data-target="#modal-delete-{{$u->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							@endif
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



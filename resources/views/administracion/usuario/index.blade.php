@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Usuarios <a href="usuario/create"> <button class="btn btn-success">Nuevo</button></a></h3>
		@include('administracion.usuario.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
		<div class="form-group">
			<label>Usuarios</label>
			<select name="id" class="form-control">
				@foreach ($usuarios as $us)
					<option value="{{$us->id}}">{{$us->name}} {{$us->apellidos}}</option>					
				@endforeach
			</select>
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
							<a href="{{URL::action('UsuarioController@show',$u->id)}}"><button class="btn btn-info">Ver</button></a>
						</td>
						<td>
							<a href="{{URL::action('UsuarioController@edit',$u->id)}}"><button class="btn btn-info">Editar</button></a>
						</td>
						<td>
							<a href="" data-target="#modal-delete-{{$u->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('administracion.usuario.modal')
				@endforeach
				</tbody>
				
			</table>
			
		</div>
		{{$usuarios->render()}}
	</div>
</div>
@endsection

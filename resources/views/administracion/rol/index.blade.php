@php
	$puede_editar = false;
    $puede_eliminar = false;
    if (Gate::allows('actualizar-seguridad')) {
        $puede_editar = true;
    }
    if (Gate::allows('eliminar-seguridad')) {
        $puede_eliminar = true;
    }
@endphp

@extends('layouts.admin')
@section('contenido')
	<div class="card">
		<div class="card-header card-header-primary">
			<h4 class="card-title ">Lista de Roles</h4>
		</div>
		<div class="card-body">
			@if (Session::has('message'))
				<div class="alert alert-info">{{ Session::get('message') }}</div>
			@endif
			<div class="row">
				@can('crear-seguridad', auth()->user())
					<div class="col-sm-12">
						<h3>Listado de Tesis <a href="administracion/rol/create"> <button class="btn btn-success">Nuevo</button></a></h3>
					</div>
				@endcan
				<div class="col-sm-12 table-responsive">
					<table class="table table-striped table-hover">
						<thead>
						<tr>
							<th>Rol</th>
							<th></th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						@foreach($roles as $key => $value)
							<tr>
								<td>{{ $value->name }}</td>
								<td>
										@if($puede_editar)
											<a href="{{ URL::to('administracion/rol/' . $value->id . '/edit') }}" class="btn btn-sm btn-warning btn-link"><button class="btn btn-warning">Editar</button></a>
										@endif
								</td>
								<td>
									@if($puede_eliminar)
										<a href="" data-target="#modal-delete-{{$value->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
									@endif
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
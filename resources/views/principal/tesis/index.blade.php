@extends ('layouts.admin')
@section ('contenido')
	<div class="col-sm-12">
		<h3>Listado de Tesis <a href="tesis/create"> <button class="btn btn-success">Nuevo</button></a></h3>
	</div>
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
							<td>{{ $t->fecha_ini}}</td>
							<td>{{ $t->fecha_fin}}</td>
							<td>
								<a href="{{URL::action('TesisController@show', $t->id)}}"><button class="btn btn-info">Ver</button></a>
							</td>
							<td>
								<a href="{{URL::action('TesisController@edit',$t->id)}}"><button class="btn btn-info">Editar</button></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
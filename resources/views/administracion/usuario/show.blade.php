@extends ('layouts.admin')
@section ('contenido')
		<div >
			
				<h3>  Usuario</h3>
						
						
			
				</div>
			</div>
			<div >
				<div class="col-md-12 col-lg-4">
					<label >Nombre</label>
					<p >{{$usuarios->name}}</p>
				</div>
				<div class="col-md-12 col-lg-4">
					<label >Apellidos</label>
					<p >{{$usuarios->apellidos}}</p>
				</div>
				<div class="col-md-12 col-lg-4">
					<label >Email</label>
					<p >{{$usuarios->email}}</p>
				</div>

					
			</div>
		


@endsection
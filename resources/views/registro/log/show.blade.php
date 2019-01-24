<!DOCTYPE html>
<html>
<head>
	<title>Listado</title>
</head>
<body>
	<h1>Reporte de actividad de Usuario</h1>
	<div>
	<div><span>ID: </span>{{ $logs->id}}</div>	
	<div><span>Nombre de la tabla :  </span>{{ $logs->nombre_tabla}}</div>	
	<div><span>Accion Realiazada :  </span>{{ $logs->accion_realizada}}</div>	
	<div><span>Fecha que se realizo :  </span>{{ $logs->created_at}}</div>	

	</div>
	

</body>
</html>




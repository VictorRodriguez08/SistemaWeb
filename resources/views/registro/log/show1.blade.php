<!DOCTYPE html>
<html>
<head>
	<title>Listado</title>
</head>
<body>
	<h1>Reporte de actividad de Usuario</h1>
	<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre Tabla </th>
      <th>Accion Realizada </th>
      <th>Fecha: </th>
    </tr>
  </thead>
  <tbody>
    @foreach($logs as $l)
      <tr>
        <td>{{ $l->id }}</td>
        <td>{{ $l->nombre_tabla }}</td>
        <td>{{ $l->accion_realizada }}</td>
        <td>{{ $l->created_at }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
	

</body>
</html>
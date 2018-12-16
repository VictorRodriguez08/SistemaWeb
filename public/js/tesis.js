$(document).ready(function(){
	$('#btnBuscarUsuario').click(function(e){
		e.preventDefault();
		$('#modalBusqueda').modal('show');
	});
	$('#btnBuscarModal').click(function(){
		$('#modalTablaUsuarios').html('');
		var criterio = $('#txtModal').val() !== "" ? $('#txtModal').val() : "all";
		$.get($('#urlBuscarUsuario').val() + "/" + criterio,function(result){
			var datos = "";
			$.each(result, function(indice, valor){
				datos += "<tr onclick='seleccionar_usuario(this)'>";
					datos += "<td class='hidden'>";
						datos += valor.id;
					datos += "</td>";
					datos += "<td>";
						datos += valor.name;
					datos += "</td>";
					datos += "<td>";
						datos += valor.apellidos;
					datos += "</td>";
				datos += "</tr>";
			});
			$('#modalTablaUsuarios').html(datos);
		});
	});
});

function seleccionar_usuario(element){
	var fila = $(element);

	var datos = "";
	datos += "<tr>";
		datos += "<td>";
			datos += $(fila.children('td')[0]).text();
		datos += "</td>";
		datos += "<td>";
			datos += $(fila.children('td')[1]).text();
		datos += "</td>";
		datos += "<td>";
			datos += $(fila.children('td')[2]).text();
		datos += "</td>";
	datos += "</tr>";
	$('#tbodyUsuariosTesis').append(datos);
	$('#modalBusqueda').modal('hide');

	var usuario = '<input name="usuario_id[]" type="hidden" value="' + $(fila.children('td')[0]).text() + '">';
	$('#listaUsuarios').append(usuario);
}
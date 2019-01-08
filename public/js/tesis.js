var maximo_tesis = 0;
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
	if(!usuario_existe($(fila.children('td')[0]).text()) && maximo_tesis < 3){
		var datos = "";
		datos += "<tr>";
			datos += "<td>";
				datos += "<a href='#' class='btn btn-danger' onclick='eliminar_usuario(" + $(fila.children('td')[0]).text() + ", this, event)'>Eliminar</a>";
			datos += "</td>";
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
		maximo_tesis++;
	}else{
		if(maximo_tesis<3){
			Swal({
				type: 'error',
				title: 'Agregar Usuario',
				text: 'El usuario ya existe, por favor seleccione otro'
			});
		}else{
			Swal({
				type: 'error',
				title: 'Agregar Usuario',
				text: 'El máximo de usuarios por tesis es: 3'
			});
		}

	}

}

function eliminar_usuario(id, element, event){
	event.preventDefault();
	var hijos = $('#listaUsuarios').children();
	var fila = $(element).closest('tr');
	$.each(hijos, function(indice, valor){
		if(parseInt($(valor).val()) === parseInt(id)){
			$(valor).remove();
			$(fila).remove();
			maximo_tesis--;
			return false;
		}
	});
}

function usuario_existe(id){
	var hijos = $('#listaUsuarios').children();
	var result = false;
	$.each(hijos, function(indice, valor){
		if(parseInt($(valor).val()) === parseInt(id)){
			result = true;
		}
	});
	return result;
}

function ver_usuarios_tesis(id, event){
	event.preventDefault();
	$('#tablaListaUsuarios').html('');
	$.get($('#urlListarUsuarios').val() + "/" + id,function(result){
		var datos = "";
		$.each(result, function(indice, valor){
			datos += "<tr>";
				datos += "<td>";
				datos += valor.nombre;
				datos += "</td>";
			datos += "</tr>";
		});
		$('#tablaListaUsuarios').html(datos);
		$('#modalListaUsuarios').modal('show');
	});
}
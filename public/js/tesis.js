var maximo_tesis = 0;
var maximo_alumnos = 0;
var maximo_asesores = 0;
var maximo_jurados = 0;
var ALUMNO = 1;
var ASESOR = 2;
var JURADO = 3;
var correlativo = 0;

var PERFIL;
var ANTEPROYECTO;
var TESIS;
var SelectEstados;

var primero_vocal = 0;
var segundo_vocal = 0;
var presidente = 0;

$(document).ready(function(){
	PERFIL = $('#PERFIL').val();
	ANTEPROYECTO = $('#ANTEPROYECTO').val();
	TESIS = $('#TESIS').val();
	SelectEstados = $('#estado_id');
	$('form').submit(function(){
		if(maximo_alumnos < 1){
			Swal({
				type: 'error',
				title: 'Agregar Tesis',
				text: 'El número de alumnos por tesis debe ser mayor o igual que 1'
			});
			return false;
		}else{
			if(!SOLO_PERFIL){
				if(maximo_asesores !== 1){
					Swal({
						type: 'error',
						title: 'Agregar Tesis',
						text: 'El número de asesores debe ser igual a 1'
					});
					return false;
				} else{
					if(parseInt(SelectEstados.val()) === parseInt(TESIS)){
						if(maximo_jurados !== 3){
							Swal({
								type: 'error',
								title: 'Agregar Tesis',
								text: 'El número de jurados debe ser igual a 3'
							});
							return false;
						}
					}
				}
			}
		}
	});

	$('#btnBuscarUsuario').click(function(e){
		e.preventDefault();
		$("#divOpciones").addClass('hide');

		$('#modalTablaUsuarios').html('');

		$('#tituloBusqueda').html("Seleccione un Alumno");

		$('#txtModal').val('');

		$('#tipoBusqueda').val(0);

		$('#modalBusqueda').modal('show');
	});
	$('#btnBuscarJurado').click(function(e){
		e.preventDefault();
		$("#divOpciones").removeClass('hide');

		$('#modalTablaUsuarios').html('');

		$('#tituloBusqueda').html("Seleccione un Asesor o Jurado");

		$('#txtModal').val('');

		$('#tipoBusqueda').val(1)

		if(presidente > 0){
			$('#select_cargo').find('option[value="0"]').attr('disabled','disabled');
		}

		if(primero_vocal > 0){
			$('#select_cargo').find('option[value="1"]').attr('disabled','disabled');
		}

		if(segundo_vocal > 0){
			$('#select_cargo').find('option[value="2"]').attr('disabled','disabled');
		}

		if(!verificar_disponibilidad(ASESOR) && verificar_disponibilidad(JURADO)){
			$('#divCargo').removeClass('hide');
		}else{
			$('#divCargo').addClass('hide');
		}

		$('#modalBusqueda').modal('show');
	});

	$('#btnBuscarModal').click(function(){
		$('#modalTablaUsuarios').html('');
		var criterio = $('#txtModal').val() !== "" ? $('#txtModal').val() : "all";
		var opcionBusqueda = $('input[name="opcionBusqueda"]:checked').val() !== undefined ? $('input[name="opcionBusqueda"]:checked').val() : "";
		var tipoBusqueda = $('#tipoBusqueda').val();

		$.get($('#urlBuscarUsuario').val() + "/" + tipoBusqueda + "/" + criterio + "/" + opcionBusqueda,function(result){
			var datos = "";
			$.each(result.data, function(indice, valor){
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
	if(!usuario_existe($(fila.children('td')[0]).text()) && maximo_tesis < 7){
		var check_alumno = false;
		var check_asesor = false;
		var check_jurado = false;
		var tipo_agregado = 0;

        if(SelectEstados.val() === PERFIL && verificar_disponibilidad(ALUMNO)){
			check_alumno = true;
			maximo_alumnos++;
			tipo_agregado = 1;
			if(verificar_disponibilidad(ASESOR)){
				$('#estado_id').find('option[value="' + ANTEPROYECTO + '"]').removeAttr('disabled');
				$('#estado_id').find('option[value="' + TESIS + '"]').attr('disabled','disabled');
			}else{
				$('#estado_id').find('option[value="' + ANTEPROYECTO + '"]').attr('disabled','disabled');
				$('#estado_id').find('option[value="' + TESIS + '"]').removeAttr('disabled');
			}
        }

        if(!SOLO_PERFIL){
			if(SelectEstados.val() === ANTEPROYECTO && verificar_disponibilidad(ASESOR)){
				check_asesor = true;
				maximo_asesores++;
				tipo_agregado = 2;
				$('#estado_id').find('option[value="' + TESIS + '"]').attr('disabled','disabled');
			}

			if(SelectEstados.val() === TESIS && verificar_disponibilidad(JURADO)){
				check_jurado = true;
				maximo_jurados++;
				tipo_agregado = 3;
				$('#estado_id').find('option[value="' + PERFIL + '"]').attr('disabled','disabled');
				$('#estado_id').find('option[value="' + ANTEPROYECTO + '"]').attr('disabled','disabled');

				if(parseInt($('#select_cargo').val()) === 0){
					presidente++;
				}else if(parseInt($('#select_cargo').val()) === 1){
					primero_vocal++;
				}else if(parseInt($('#select_cargo').val()) === 2){
					segundo_vocal++;
				}
			}

		}

		if(check_alumno || check_asesor || check_jurado){
			var datos = "";
			var name_radio = "optionsRadios" + correlativo++;

			datos += "<tr>";
				datos += "<td>";
					datos += "<a href='#' class='btn btn-danger' onclick='eliminar_usuario(" + $(fila.children('td')[0]).text() + "," +tipo_agregado +"," + $('#select_cargo').val()  + ", this, event)'>Eliminar</a>";
				datos += "</td>";
				datos += "<td class='hidden'>";
					datos += $(fila.children('td')[0]).text();
				datos += "</td>";
				datos += "<td>";
					datos += $(fila.children('td')[1]).text();
				datos += "</td>";
				datos += "<td>";
					datos += $(fila.children('td')[2]).text();
				datos += "</td>";
				datos += "<td><div class=\"radio\"><label><input type=\"radio\" name="+ name_radio +" id=\"optionsRadios1\" value='1' " + (check_jurado ? "checked" : "" ) + " disabled></label></div></td>";
				datos += "<td><div class=\"radio\"><label><input type=\"radio\" name="+ name_radio +" id=\"optionsRadios1\" value='2' " + (check_asesor ? "checked" : "" ) +" disabled></label></div></td>";
				datos += "<td><div class=\"radio\"><label><input type=\"radio\" name="+ name_radio +" id=\"optionsRadios1\" value='3' " + (check_alumno ? "checked" : "" ) + " disabled></label></div></td>";
				datos += "<td>";
					datos += (check_jurado ? $('#select_cargo').find('option:selected').text()  : "");
				datos += "</td>";
			datos += "</tr>";
			$('#tbodyUsuariosTesis').append(datos);

			var usuario = '<input name="usuario_id[]" type="hidden" value="' + $(fila.children('td')[0]).text() + "_" + tipo_agregado + (check_jurado ? "_" + $('#select_cargo').find('option:selected').text() : "" )+'">';
			$('#listaUsuarios').append(usuario);
			maximo_tesis++;
		}
		$('#modalBusqueda').modal('hide');
	}else{
		if(maximo_tesis<7){
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

function verificar_disponibilidad(tipo){
	switch(tipo){
		case 1:{
			return maximo_alumnos < 3;
		}
		case 2:{
			return maximo_asesores < 1;
		}
		case 3:{
			return maximo_jurados < 3;
		}

	}
}

function mostrar_error_maximo(){
	if(maximo_alumnos >=3){
		console.log("maximo de alumnos permitidos es 3")
	}
	if(maximo_asesores >= 1){
		console.log("maximo de alumnos permitidos es 3")
	}
	if(maximo_juradoso >= 3){
		console.log("maximo de alumnos permitidos es 3")
	}
}

function eliminar_usuario(id, tipo_eliminado, cargo, element, event){
	event.preventDefault();
	tipo_eliminado = parseInt(tipo_eliminado);
	var hijos = $('#listaUsuarios').children();
	var fila = $(element).closest('tr');

	if(parseInt(cargo) === 0){
		presidente--;
	}else if(parseInt(cargo) === 1){
		primero_vocal--;
	}else if(parseInt(cargo) === 2){
		segundo_vocal--;
	}

	$.each(hijos, function(indice, valor){
		if(parseInt($(valor).val()) === parseInt(id)){
			$(valor).remove();
			$(fila).remove();
			maximo_tesis--;
			agregar_disponibilidad_por_tipo_eliminado(tipo_eliminado);
			return false;
		}
	});
}

function agregar_disponibilidad_por_tipo_eliminado(tipo_eliminado){
	switch(tipo_eliminado){
		case 1:{
			maximo_alumnos--;
			break;
		}
		case 2:{
			maximo_asesores--;
			break;
		}
		case 3:{
			maximo_jurados--;
			break;
		}

	}
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

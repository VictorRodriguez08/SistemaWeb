
function ver_usuarios(id, event){
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

        $('#modalListaUsuarios').find('.modal-title').text('Lista de Usuarios que pertenecen al Congreso ');
        $('#colAdicional').addClass('hidden');

        $('#modalListaUsuarios').modal('show');
    });
}


function ver_archivos(id, event){
    event.preventDefault();
    $('#tablaListaUsuarios').html('');
    $.get($('#urlListarArchivos').val() + "/" + id,function(result){
        var datos = "";
        $.each(result, function(indice, valor){
            datos += "<tr>";
                datos += "<td>";
                datos += valor.nombre_archivo;
                datos += "</td>";
                datos += "<td>";
                datos += "<a href='/"+ valor.ruta_archivo + "'><i class='glyphicon glyphicon-download'></i></a>";
                datos += "</td>";
            datos += "</tr>";
        });
        $('#tablaListaUsuarios').html(datos);

        $('#modalListaUsuarios').find('.modal-title').text('Lista de Archivos');

        $('#colAdicional').removeClass('hidden');

        $('#modalListaUsuarios').modal('show');
    });
}

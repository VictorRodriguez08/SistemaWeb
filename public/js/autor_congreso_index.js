
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
        $('#modalListaUsuarios').modal('show');
    });
}

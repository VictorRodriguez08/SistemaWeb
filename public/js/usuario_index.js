
function ver_usuarios(id, event){
    event.preventDefault();
    $('#tablaUsuarios').html('');
    $.get($('#urlListarUsuario').val() + "/" + id,function(result){
        var datos = "";
        datos="<tr>";
        datos=nombre;
        
        $('#tablaUsuarios').html(datos);
        $('#modalListaUsuarios').modal('show');
    });
}
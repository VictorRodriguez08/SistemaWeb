
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
            datos += "<td>";
            datos += "<b>" +valor.rol + "</b>";
            datos += "</td>";
            datos += "</tr>";
        });
        $('#tablaListaUsuarios').html(datos);
        $('#modalListaUsuarios').modal('show');
    });
}

function cartas_avance(url, event) {
    event.preventDefault();


    Swal.fire({
        title: 'Cartas de avance',
        input: 'select',
        inputOptions: {
            '0': 'Observaciones',
            '1': 'Avance',
            '2': 'Documento final',
            '3': 'Carta de Asesor'
        },
        inputPlaceholder: 'Seleccione un tipo de carta',
        showCancelButton: true,
        inputValidator: (value) => {
            return new Promise((resolve) => {
                if (value === "") {
                    resolve('Debe seleccionar un tipo de carta')
                }
                resolve();
            })
        }
    }).then(function (result) {
        window.location = url + "/" + result.value;
    });
}
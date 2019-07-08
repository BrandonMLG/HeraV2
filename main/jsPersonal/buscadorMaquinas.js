$(obtener_registros());

function obtener_registros(busqueda)
{
    $.ajax({
        url: 'buscarMaquinas.php',
        type: 'POST',
        dataType: 'html',
        data: {busqueda: busqueda},
    })

            .done(function (resultado) {
                $("#tabla_resultado").html(resultado);
            })
}

$(document).on('keyup', '#busqueda', function ()
{
    var valorBusqueda = $(this).val();
    if (valorBusqueda != "")
    {
        obtener_registros(valorBusqueda);
    } else
    {
        obtener_registros();
    }
});

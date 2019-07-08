<?php

include '../../Logica/BackEnd.php';
include '../../Modelo/Modelo.php';

$BE = new BackEnd;
$FE = new Modelo();

$contenido = '';

$acu = '';


if (isset($_POST['busqueda'])) {

    if ($_POST['busqueda'] === '') {
        $acu = $acu . ' <div id="contenedor_spinner">
            <div id="contenedor_carga">
                            <div id="carga"></div>
                        </div>
                        <div class="text-center mt-2" id="pelota"><H4>Por favor ingresa el <strong>Código de la Maquina</strong> que deseas modificar.</H4></div>
                         </div>
                        ';
    }
    if ($_POST['busqueda'] <> '' && $_POST['busqueda'] <> 'select') {

         $acu = $BE->buscarRefaccion($_POST['busqueda']);

    }
}

echo $acu;
?>
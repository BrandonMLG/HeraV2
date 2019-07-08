<?php

include '../../Modelo/Modelo.php';
$CONE = new Modelo();

$acu = '';

if (isset($_POST['busqueda'])) {
    if ($_POST['busqueda']<>'') {
        $acu = $CONE->BuscarDescripcionModulo($_POST['busqueda']); 
    }
}
echo $acu;
?>
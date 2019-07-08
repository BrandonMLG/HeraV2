<?php

include '../../Logica/BackEnd.php';
include '../../Modelo/Modelo.php';

$BE = new BackEnd;
$refacciones = '';
if (isset($_POST['tipo'])) {
    $refacciones = $BE->buscarInOutRef($_POST['tipo'], $_POST['inicio'], $_POST['fin']);
}
echo $refacciones;
?>
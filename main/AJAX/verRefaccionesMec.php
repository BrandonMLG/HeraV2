<?php

include '../../Logica/BackEnd.php';
include '../../Modelo/Modelo.php';

$BE = new BackEnd;
$maquinaria = '';
if (isset($_POST['busqueda'])) {
    $maquinaria = $_POST['busqueda'];
    $maquinaria = $BE->buscarRefaccionesMec($_POST['busqueda'], $_POST['filtroBusqueda'] );
}
echo $maquinaria;
?>
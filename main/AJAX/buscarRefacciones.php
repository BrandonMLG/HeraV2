<?php

include '../../Logica/BackEnd.php';
include '../../Modelo/Modelo.php';

$BE = new BackEnd;
$maquinaria = '';
if (isset($_POST['busqueda'])) {
    $maquinaria = $_POST['busqueda'];
    $maquinaria = $BE->buscarRefacciones($_POST['busqueda'], $_POST['filtroBusqueda'], $_POST['estadoRefaccion']);
}
echo $maquinaria;
?>
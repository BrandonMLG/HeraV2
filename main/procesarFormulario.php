<?php

include_once '../Modelo/Modelo.php';
include_once '../Logica/BackEnd.php';
$BE = new BackEnd;

if ($_POST["formValue"] === '1') {
    $BE->registrarUsuaurio();
}else if($_POST["formValue"] === '2'){
    $BE->registrarModulo();
}else if($_POST["formValue"] === '3'){
    $BE->registrarInterfaz();
}else if($_POST["formValue"] === '4'){
    $BE->registrarPerfil();
}else if($_POST["formValue"] === '5'){
    $BE->registrarPerfil_Interfaz();
}else if($_POST["formValue"] === '6'){
    $BE->registrarPerfil_Usuario();
}
?>

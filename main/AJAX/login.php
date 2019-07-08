<?php

include '../../Logica/BackEnd.php';
include '../../Modelo/Modelo.php';

$BE = new BackEnd;
$CONE = new Modelo();
$contenido = '';

//Comprobar nombre usuario
if ($BE->consultarUsuario($_POST["usuario"])) {
    //El usuario y contraseña son correctas
    if ($BE->consultarUsuarioPassword($_POST["usuario"], $_POST["password"])) {
        $BE->autentificar2($_POST["usuario"], $_POST["password"]);
        echo var_dump($_SESSION);
    } else {
        //La contraseña es incorrecta
        echo 'error Contraseña';
    }
} else {
    //El usuario ingresado no existe
    echo 'error Usuario';
}
?>
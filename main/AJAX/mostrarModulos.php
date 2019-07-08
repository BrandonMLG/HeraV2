<?php

include '../../Logica/BackEnd.php';
include '../../Modelo/Modelo.php';

$BE = new BackEnd;
$r ='';
if (isset($_POST['busqueda'])) {
   if ($_POST['busqueda']<>'0') {
       $r = $BE->mostrarModulos($_POST['busqueda']);
    }
}
echo $r;
?>
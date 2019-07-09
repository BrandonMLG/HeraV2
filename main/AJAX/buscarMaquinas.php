<?php

include '../../Logica/BackEnd.php';
include '../../Modelo/Modelo.php';

$BE = new BackEnd;
$maquinaria ='';
if (isset($_POST['busqueda'])) {
     $maquinaria= $_POST['busqueda'];
   if ($_POST['busqueda']<>'') {
         $maquinaria = $BE->buscarMaquinaria($_POST['busqueda'],$_POST['criterio'],$_POST['estado'],$_POST["ubicacion"]);
    }else{
         $maquinaria = $BE->mostrarMaquinariaV2($_POST['estado'],$_POST["ubicacion"]);
    }
}
echo $maquinaria;
?>
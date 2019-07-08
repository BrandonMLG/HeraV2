<?php

include '../../Logica/BackEnd.php';
include '../../Modelo/Modelo.php';

$BE = new BackEnd;
$reporte ='';
if (isset($_POST['busqueda'])) {
     $reporte = $_POST['busqueda'];
   if ($_POST['busqueda']<>'') {
         $reporte = $BE->mostrarMttosPreventivos2($_POST['busqueda'],$_POST['criterio']);
    }else{
         $reporte = $BE->mostrarMttosPreventivos();
    }
}
echo $reporte;
?>
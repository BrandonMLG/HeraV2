<?php

include_once '../Modelo/Modelo.php';
include_once '../Logica/BackEnd.php';
$BE = new BackEnd;

if ($_POST["formValue"] === '1') {
    $BE->registrarModulo_ChecklistMP();
}else if($_POST["formValue"] === '2'){
    $BE->registrarActividadModulo_ChecklistMP();
}else if($_POST["formValue"] === '3'){
    $BE->actualizarModulo_ChecklistMP();
}else if($_POST["formValue"] === '4'){
    $BE->actualizarActividadModulo_ChecklistMP();
}else if($_POST["formValue"] === '5'){
    $BE->eliminarModulo_ChecklistMP();
}else if($_POST["formValue"] === '6'){
    $BE->eliminarActividadModulo_ChecklistMP();
}
?>

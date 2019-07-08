<?php

include '../../Modelo/Modelo.php';
$CONE = new Modelo();


if (isset($_POST['busqueda'])) {
    if ($_POST['busqueda'] <> '') {
         if($CONE->buscarMaquinariaID($_POST['busqueda'])){
              echo json_encode( $CONE->buscarMaquinariaID($_POST['busqueda']));
         }else{
               echo '{"Orden":"","NumeroActivo":"","Maquina":" ","Marca":"","Modelo":"","Serie":"","Ubicacion":"","UltimaActualizacion":"","Comentario":"","Estado":"","Propietario":""}';
         }
    }else{
        echo '{"Orden":"","NumeroActivo":"","Maquina":" ","Marca":"","Modelo":"","Serie":"","Ubicacion":"","UltimaActualizacion":"","Comentario":"","Estado":"","Propietario":""}';
    } 
}
?>
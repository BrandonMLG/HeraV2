<?php
//
//include '../../Logica/BackEnd.php';
//include '../../Modelo/Modelo.php';
//
//$BE = new BackEnd;
//
//$ID_Mtto = $_POST["busqueda"];

if (file_exists("../../fpdf181/documentos/MP-3.pdf")) {
    header("Content-disposition: attachment; filename=MP-3.pdf");
    header("Content-type: application/zip");
    readfile("../../fpdf181/documentos/MP-3.pdf");
}
?>
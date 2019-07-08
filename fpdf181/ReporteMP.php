<?php

include '../Modelo/Modelo.php';
include '../Logica/BackEnd.php';

$BE = new BackEnd();
$Conexion = new Modelo();

require('fpdf.php');

class PDF extends FPDF {

// Cabecera de página
    function Header() {

        // Logo
        $this->Image('imagenes/logoHeraApparel.png', 7, 1, 40);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30, 15, 'Reporte de Mantenimiento Preventivo', 0, 0, 'C');
        $this->SetFont('helvetica', 'B', 10);
        //Nombre del Formato
        $this->Cell(40);
        $this->Cell(0, 5, 'FORMATO: FMEC-001', 0, 0, 'C');


        // Salto de línea
        $this->Ln(20);
    }

// Pie de página
    function Footer() {
        $Conexion = new Modelo();
        $usuario = $Conexion->buscarUserMtto_Pre($_GET["ID_Mtto"]);
        // Posición: a 1,5 cm del final
        $this->SetY(-50);
        // Arial italic 8
        $this->SetFont('Arial', 'IU', 11);
        // Número de página
        $this->Cell(0, 10, $this->Decode($usuario["Usuario"]), 0, 0, 'C');

        // Posición: a 1,5 cm del final
        $this->SetY(-45);
        // Arial italic 8
        $this->SetFont('Arial', 'B', 11);
        // Número de página
        $this->Cell(0, 10, $this->Decode('Nombre del Inspector'), 0, 0, 'C');


        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, $this->Decode('Página') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function Generalidades() {
        $Conexion = new Modelo();

        $inforMaquina = $Conexion->buscarMaquinaMtto_Pre($_GET["ID_Mtto"]);


        $this->SetXY(10, 35);
        $this->SetFillColor(20, 33, 89);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(192, 6, 'GENERALIDADES:', 1, 0, 'C', 1);
        $this->Ln();

        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 0, 0);

        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 5, 'No. Maquina:', 1, 0, '', 1);
        $this->SetFont('Arial', '', 10);
        $this->Cell(20, 5, $this->Decode($inforMaquina["NumeroActivo"]), 1, 0, 'C', 1);

        $this->SetFont('Arial', 'B', 11);
        $this->Cell(25, 5, 'Maquina:', 1, 0, 'C', 1);
        $this->SetFont('Arial', '', 9);
        $this->Cell(70, 5, $this->Decode($inforMaquina["Maquina"]), 1, 0, 'C', 1);


        $this->SetFont('Arial', 'B', 11);
        $this->Cell(30, 5, 'No_Mantto:', 1, 0, 'C', 1);
        $this->SetFont('Arial', '', 9);
        $this->Cell(17, 5, $this->Decode('MP-' . $_GET["ID_Mtto"]), 1, 0, 'C', 1);

        $this->Ln();
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(17, 5, 'Marca:', 1, 0, '', 1);
        $this->SetFont('Arial', '', 8);
        $this->Cell(45, 5, $this->Decode($inforMaquina["Marca"]), 1, 0, 'C', 1);

        $this->SetFont('Arial', 'B', 11);
        $this->Cell(20, 5, 'Modelo:', 1, 0, 'C', 1);
        $this->SetFont('Arial', '', 8);
        $this->Cell(45, 5, $this->Decode($inforMaquina["Modelo"]), 1, 0, 'C', 1);

        $this->SetFont('Arial', 'B', 11);
        $this->Cell(20, 5, 'No.Serie:', 1, 0, 'C', 1);
        $this->SetFont('Arial', '', 8);
        $this->Cell(45, 5, $this->Decode($inforMaquina["Serie"]), 1, 0, 'C', 1);
    }

    function ListaObservaciones() {
        $Conexion = new Modelo();

        $mtto = $Conexion->buscarMtto_Pre($_GET["ID_Mtto"]);
        $usuario = $Conexion->buscarUserMtto_Pre($_GET["ID_Mtto"]);

        $this->SetXY(10, 65);
        $this->SetFillColor(20, 33, 89);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(93, 6, 'CUESTIONARIO DE CHEQUEO:', 1, 0, 'C', 1);

        $this->SetXY(109, 65);
        $this->SetFillColor(20, 33, 89);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(93, 6, 'OBSERVACIONES DEL INSPECTOR:', 1, 0, 'C', 1);

        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 0, 0);


        $anchoModulos = 8;
        $anchoContenido = 5;

        $this->SetXY(109, 71);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(93, $anchoModulos, '  COMENTARIOS:', 1, 0, '', 1);


        $Y0 = $this->GetY();
        $this->SetXY(109, $Y0 + $anchoModulos);
        $this->SetFont('helvetica', '', 11);
        $this->MultiCell(93, $anchoContenido, $this->Decode($mtto["descripcion"]), 1);

        $Y = $this->GetY();
        $this->SetXY(109, $Y);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(93, $anchoModulos, '  CAMBIO DE PIEZAS:', 1, 0, '', 1);

        $Y2 = $this->GetY();
        $this->SetXY(109, $Y2 + $anchoModulos);
        $this->SetFont('helvetica', '', 11);
        $this->MultiCell(93, $anchoContenido, $this->Decode($this->Decode($mtto["piezas"])), 1);

        $Y3 = $this->GetY();
        $this->SetXY(109, $Y3);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(93, $anchoModulos, '  OBSERVACIONES:', 1, 0, '', 1);

        $Y4 = $this->GetY();
        $this->SetXY(109, $Y4 + $anchoModulos);
        $this->SetFont('helvetica', '', 11);
        $this->MultiCell(93, $anchoContenido, $this->Decode($this->Decode($mtto["observaciones"])), 1);

        $Y5 = $this->GetY();
        $this->SetXY(109, $Y5 + $anchoModulos);
        $this->SetFont('Arial', 'B', 11);
        $this->SetFillColor(20, 33, 89);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(93, $anchoModulos, '  CIERRE:', 1, 0, 'C', 1);

        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 0, 0);

        $Y6 = $this->GetY();
        $this->SetXY(109, $Y6 + $anchoModulos);
        $this->SetFont('helvetica', '', 11);
        $this->MultiCell(93, $anchoContenido, $this->Decode('El presente Checklist refleja la inpección realizada a cargo del C. ' . $usuario["Usuario"] . ', colaborador de la Empresa Hera Apparel S.A. de C.V. perteneciente al Depto: ' . $usuario["Departamento"] . ', mismo checklist deberá funjir como historico para los futuros Mantenimientos Preventivos a realizar.'), 1);

        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 0, 0);

        $Y7 = $this->GetY();
        $this->SetXY(109, $Y7);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(33, $anchoModulos, ' TIEMPO:', 1, 0, 'C', 1);

        $this->SetXY(142, $Y7);
        $this->SetFont('Arial', 'I', 11);
        $this->Cell(60, $anchoModulos, $this->Decode($mtto["tiempo_requerido"]) . ' (HH:MM:SS)', 1, 0, 'C', 1);


        $this->SetXY(10, 71);
        $modulos = $Conexion->buscarModulosMtto_Pre($_GET["ID_Mtto"]);
        $cont1 = 1;
        foreach ($modulos as $m) {
            $this->SetFont('Arial', 'B', 11);
            $modulo = $this->Decode($m["modulo"]);
            $modulo = $cont1 . '. ' . $modulo;
            $this->Cell(93, 6, $modulo, 1);
            $this->Ln();
            $this->SetFont('Arial', '', 10);
            $actividades = $Conexion->buscarActividadesMtto_Pre($_GET["ID_Mtto"], $m["ID_Modulo"]);
            $cont2 = 1;

            foreach ($actividades as $a) {
                $actividad = $this->Decode($a["actividad"]);
                $actividad = $cont1 . '.' . $cont2 . ' ' . $actividad;
                $this->Cell(53, 5, $actividad, 1);
                $this->Cell(40, 5, ( $this->Decode($a["status"])), 1, 0, 'C');
                $this->Ln();
                $cont2++;
            }
            $cont1++;
        }
    }

    function Decode($txt) {
        return utf8_decode($txt);
    }

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P', 'Letter');


$fecha = $Conexion->buscarMtto_Pre($_GET["ID_Mtto"]);
$fecha2 = $BE->fechaMx($fecha["fecha"]);

$pdf->SetXY(162, 15);
$pdf->SetFillColor(20, 33, 89);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(40, 6, 'Fecha: ' . $fecha2, 1, 0, 'C', 1);

$pdf->Generalidades();
$pdf->ListaObservaciones();

//$pdf->Output();
$pdf->Output("documentos/MP-" . $_GET["ID_Mtto"] . ".pdf", "F");
$BE->redireccionar('../main/ChecklistMP.php?status='. md5("success").'');
?>
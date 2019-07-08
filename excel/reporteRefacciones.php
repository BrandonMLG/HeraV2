<?php

require 'Classes/PHPExcel.php';
require 'conexion.php';


$criterioBusqueda = 'Concentrado';
if ($_GET["busqueda"] <> "") {
    $criterioBusqueda = $_GET["busqueda"];
}

if ($_GET["busqueda"] <> "") {
    $criterioBusqueda = $_GET["busqueda"];
    $filtro = $_GET["filtro"];
    $estado = $_GET["estado"];

    if ($estado <> 0) {
        $sql = 'SELECT  * FROM refaccion WHERE ' . $filtro . ' LIKE "%' . $criterioBusqueda . '%" and ID_Estado = ' . $estado . '';
        $mysqli->set_charset("utf8");
    } else {
        $sql = 'SELECT  * FROM refaccion WHERE ' . $filtro . ' LIKE "%' . $criterioBusqueda . '%"';
        $mysqli->set_charset("utf8");
    }
} else {
    $sql = "SELECT * FROM refaccion";
    $mysqli->set_charset("utf8");
}

$resultado = $mysqli->query($sql);



$estiloTituloColumnas = array(
    'font' => array(
        'name' => 'Arial',
        'bold' => true,
        'size' => 14,
        'color' => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '538DD5')
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
);

$estiloInformacion = new PHPExcel_Style();
$estiloInformacion->applyFromArray(array(
    'font' => array(
        'name' => 'Arial',
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
));


$estiloInformacionNegritas = new PHPExcel_Style();
$estiloInformacionNegritas->applyFromArray(array(
    'font' => array(
        'name' => 'Arial',
        'bold' => true,
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
));

$estiloAmarrillo = array(
    'font' => array(
        'name' => 'Arial',
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'ffff00')
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
        ));




$estiloTituloReporte = array(
    'font' => array(
        'name' => 'Arial',
        'bold' => true,
        'italic' => false,
        'strike' => false,
        'size' => 22
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
);


$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Administrador")->setDescription("Reporte de Refacciones Hera Apparel");

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("Reporte");

//URL Logo Hera  
$gdImage = imagecreatefrompng('images/logoAzul.png'); //Logotipo
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setName('Logotipo');
$objDrawing->setDescription('Logotipo');
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(70);
$objDrawing->setCoordinates('C1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());


//URL Mascota Hera  
$gdImage2 = imagecreatefrompng('images/HERA2.png'); //Logotipo
$objDrawing2 = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing2->setName('Logotipo');
$objDrawing2->setDescription('Logotipo');
$objDrawing2->setImageResource($gdImage2);
$objDrawing2->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
$objDrawing2->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing2->setHeight(60);
$objDrawing2->setCoordinates('I1');
$objDrawing2->setWorksheet($objPHPExcel->getActiveSheet());


//Titulo 
$objPHPExcel->getActiveSheet()->getStyle('A1:K4')->applyFromArray($estiloTituloReporte);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:K4');
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'CONCENTRADO DE REFFACCIONES HERA APPAREL S.A. DE C.V');




//Header
$objPHPExcel->getActiveSheet()->setCellValue('A5', 'Orden');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->setCellValue('B5', 'Estante');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->setCellValue('C5', 'Descripcion');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->setCellValue('D5', 'Clave');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->setCellValue('E5', 'Maquina');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->setCellValue('F5', 'Marca');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->setCellValue('G5', 'Modelo');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->setCellValue('H5', 'Bueno');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->setCellValue('I5', 'Regular');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->setCellValue('J5', 'Malo');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->setCellValue('K5', 'Stock');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(TRUE);

$objPHPExcel->getActiveSheet()->getStyle('A5:K5')->applyFromArray($estiloTituloColumnas);


$fila = 6;

while ($row = $resultado->fetch_assoc()) {

    $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, '' . ($fila - 5) . '');
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $row['estante']);
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $row['descripcion']);
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $row['clave']);
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['maquina']);
    $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['marca']);
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['modelo']);
    $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['status_ok']);
    $objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['status_regular']);
    $objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['status_malo']);
    $objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['stock']);
    $fila++;
}
$fila = $fila - 1;


$objPHPExcel->getActiveSheet()->getStyle("A6:A" . $fila)->applyFromArray($estiloAmarrillo);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "C6:J" . $fila);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacionNegritas, "B6:B" . $fila);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacionNegritas, "K6:K" . $fila);

$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(83);

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Disposition: attachment;filename="' . $criterioBusqueda . '.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('php://output');
?>
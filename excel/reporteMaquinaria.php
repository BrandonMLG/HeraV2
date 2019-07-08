<?php

require 'Classes/PHPExcel.php';
require 'conexion.php';

$estado  = $_GET["estado"];

$sql = 'SELECT * FROM Maquinaria WHERE estado like "%'.$estado.'%"';
    
$mysqli->set_charset("utf8");
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


$AMARILLO = array(
    'font' => array(
        'name' => 'Arial',
         'bold' => true,
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


$VERDE = array(
    'font' => array(
        'name' => 'Arial',
         'bold' => true,
        'color' => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '19EC00')
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

$ROJO = array(
    'font' => array(
        'name' => 'Arial',
         'bold' => true,
        'color' => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'EA0000')
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

$NEGRO = array(
    'font' => array(
        'name' => 'Arial',
         'bold' => true,
        'color' => array(
            'rgb' => 'ffffff'
        )
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '000000')
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
$objPHPExcel->getProperties()->setCreator("Administrador")->setDescription("Reporte de Maquinaria Hera Apparel");

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("Maquinaria");

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
$objPHPExcel->getActiveSheet()->getStyle('A1:J4')->applyFromArray($estiloTituloReporte);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J4');
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'CONCENTRADO DE MAQUINARIA HERA APPAREL S.A. DE C.V');




//Header
$objPHPExcel->getActiveSheet()->setCellValue('A5', 'Orden');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7.56);
$objPHPExcel->getActiveSheet()->setCellValue('B5', 'Num.');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
$objPHPExcel->getActiveSheet()->setCellValue('C5', 'Maquina');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(33.22);
$objPHPExcel->getActiveSheet()->setCellValue('D5', 'Marca');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(22.22);
$objPHPExcel->getActiveSheet()->setCellValue('E5', 'Modelo');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(17.78);
$objPHPExcel->getActiveSheet()->setCellValue('F5', 'Serie');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15.56);
$objPHPExcel->getActiveSheet()->setCellValue('G5', 'Ubicacion');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(33.22);
$objPHPExcel->getActiveSheet()->setCellValue('H5', 'Comentario');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(55.22);
$objPHPExcel->getActiveSheet()->setCellValue('I5', 'Estado');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(11.5);
$objPHPExcel->getActiveSheet()->setCellValue('J5', 'Propietario');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(26.44);

$objPHPExcel->getActiveSheet()->getStyle('A5:J5')->applyFromArray($estiloTituloColumnas);


$fila = 6;

while ($row = $resultado->fetch_assoc()) {

    $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, '' . ($fila - 4) . '');
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $row['NumeroActivo']);
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $row['Maquina']);
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $row['Marca']);
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['Modelo']);
    $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['Serie']);
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['Ubicacion']);
    $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['Comentario']);
    $objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['Estado']);
    if (trim($row['Estado']) == 'VERDE') {
        $objPHPExcel->getActiveSheet()->getStyle("I" . $fila)->applyFromArray($VERDE);
    }elseif(trim($row['Estado']) == 'AMARILLO') {
        $objPHPExcel->getActiveSheet()->getStyle("I" . $fila)->applyFromArray($AMARILLO);
    }elseif (trim($row['Estado']) == 'ROJO') {
        $objPHPExcel->getActiveSheet()->getStyle("I" . $fila)->applyFromArray($ROJO);
    }elseif (trim($row['Estado']) == 'NEGRO') {
        $objPHPExcel->getActiveSheet()->getStyle("I" . $fila)->applyFromArray($NEGRO);
    } else {
        $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "B6:H" . $fila);
    }
    
    $objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['Propietario']);


    $fila++;
}
$fila = $fila - 1;




$objPHPExcel->getActiveSheet()->getStyle("A6:A" . $fila)->applyFromArray($estiloAmarrillo);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "B6:H" . $fila);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "J6:J" . $fila);

$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(85);

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Disposition: attachment;filename="ConcentradoMaquinaria.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('php://output');
?>
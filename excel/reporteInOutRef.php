<?php

include '../Logica/BackEnd.php';
include '../Modelo/Modelo.php';
$BE = new BackEnd;

require 'Classes/PHPExcel.php';
require 'conexion.php';

$tipo = $_GET["tipo"];
$inicio = $_GET["inicio"];
$fin = $_GET["fin"];

$sql = 'SELECT * FROM ' . $tipo . ' INNER JOIN refaccion ON ' . $tipo . '.ID_Refaccion = refaccion.ID_Refaccion WHERE fecha BETWEEN "' . $inicio .
        '" AND "' . $fin . ' 23:59:59" ORDER BY fecha DESC';
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
$objPHPExcel->getActiveSheet()->setTitle($tipo);

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
$objDrawing2->setCoordinates('O1');
$objDrawing2->setWorksheet($objPHPExcel->getActiveSheet());


if ($tipo === "entrada_refaccion") {
//Titulo 
    $objPHPExcel->getActiveSheet()->getStyle('A1:Q4')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:Q4');
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'REPORTE DE ENTRADAS (' . $BE->fechaMx($inicio) . ' al ' . $BE->fechaMx($fin) . ')');
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
    $objPHPExcel->getActiveSheet()->setCellValue('H5', 'Cantidad');
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(TRUE);
    $objPHPExcel->getActiveSheet()->setCellValue('I5', 'Unidad');
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(TRUE);
    $objPHPExcel->getActiveSheet()->setCellValue('J5', 'Fecha');
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(TRUE);
    $objPHPExcel->getActiveSheet()->setCellValue('K5', 'Factura');
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(TRUE);
    $objPHPExcel->getActiveSheet()->setCellValue('L5', 'Orden C.');
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(TRUE);
    $objPHPExcel->getActiveSheet()->setCellValue('M5', 'Proveedor.');

    $objPHPExcel->getActiveSheet()->setCellValue('N5', 'Precio U.');
    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(TRUE);
    $objPHPExcel->getActiveSheet()->setCellValue('O5', 'Subtotal');
    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(TRUE);
    $objPHPExcel->getActiveSheet()->setCellValue('P5', 'IVA');
    $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(TRUE);
    $objPHPExcel->getActiveSheet()->setCellValue('Q5', 'Total');
    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(TRUE);

    $objPHPExcel->getActiveSheet()->getStyle('A5:Q5')->applyFromArray($estiloTituloColumnas);


    $fila = 6;

    while ($row = $resultado->fetch_assoc()) {
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, '' . ($fila - 5) . '');
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $row['estante']);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $row['descripcion']);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $row['clave']);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['maquina']);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['marca']);
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['modelo']);
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['cantidad']);
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['unidad_medida']);
        $objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $BE->fechaMxHora($row['fecha']));
        $objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['factura']);
        $objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $row['orden_compra']);
        $objPHPExcel->getActiveSheet()->setCellValue('M' . $fila, $row['proveedor']);
        $objPHPExcel->getActiveSheet()->setCellValue('N' . $fila, $row['precio_unitario']);
        $objPHPExcel->getActiveSheet()->setCellValue('O' . $fila, $row['subtotal']);
        $objPHPExcel->getActiveSheet()->setCellValue('P' . $fila, $row['IVA']);
        $objPHPExcel->getActiveSheet()->setCellValue('Q' . $fila, $row['total']);
        $fila++;
    }
    
    $fila = $fila - 1;
    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(TRUE);

    //Total 1
    $sentencia1 = 'SELECT sum(subtotal) AS importe FROM ' . $tipo . ' INNER JOIN refaccion ON ' . $tipo . '.ID_Refaccion = refaccion.ID_Refaccion WHERE fecha BETWEEN "' . $inicio .
            '" AND "' . $fin . ' 23:59:59" ORDER BY fecha DESC';
    $mysqli->set_charset("utf8");
    $resultado1 = $mysqli->query($sentencia1);
    while ($row = $resultado1->fetch_assoc()) {
        $objPHPExcel->getActiveSheet()->setCellValue('O' . ($fila + 1), $BE->darFormatoMoneda($row["importe"]));
    }
    //Total 2
    $sentencia2 = 'SELECT sum(IVA) AS importe FROM ' . $tipo . ' INNER JOIN refaccion ON ' . $tipo . '.ID_Refaccion = refaccion.ID_Refaccion WHERE fecha BETWEEN "' . $inicio .
            '" AND "' . $fin . ' 23:59:59" ORDER BY fecha DESC';
    $mysqli->set_charset("utf8");
    $resultado2 = $mysqli->query($sentencia2);
    while ($row = $resultado2->fetch_assoc()) {
        $objPHPExcel->getActiveSheet()->setCellValue('P' . ($fila + 1), $BE->darFormatoMoneda($row["importe"]));
    }
    //Total 3
    $sentencia3 = 'SELECT sum(Total) AS importe FROM ' . $tipo . ' INNER JOIN refaccion ON ' . $tipo . '.ID_Refaccion = refaccion.ID_Refaccion WHERE fecha BETWEEN "' . $inicio .
            '" AND "' . $fin . ' 23:59:59" ORDER BY fecha DESC';
    $mysqli->set_charset("utf8");
    $resultado3 = $mysqli->query($sentencia3);
    while ($row = $resultado3->fetch_assoc()) {
        $objPHPExcel->getActiveSheet()->setCellValue('Q' . ($fila + 1), $BE->darFormatoMoneda($row["importe"]));
    }

    $objPHPExcel->getActiveSheet()->setCellValue('N' . ($fila + 1), 'Totales');
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "N" . ($fila + 1) . ":Q" . ($fila + 1));
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacionNegritas, "N" . ($fila + 1) . ":Q" . ($fila + 1));

    $objPHPExcel->getActiveSheet()->getStyle("A6:A" . $fila)->applyFromArray($estiloAmarrillo);
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "C6:Q" . $fila);
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacionNegritas, "B6:C" . $fila);
} else {
//Titulo 
    $objPHPExcel->getActiveSheet()->getStyle('A1:P4')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:P4');
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'REPORTE DE ENTRADAS (' . $BE->fechaMx($inicio) . ' al ' . $BE->fechaMx($fin) . ')');
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
    $objPHPExcel->getActiveSheet()->setCellValue('H5', 'Cantidad');
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(TRUE);
    $objPHPExcel->getActiveSheet()->setCellValue('I5', 'Unidad');
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(TRUE);
    $objPHPExcel->getActiveSheet()->setCellValue('J5', 'Fecha');
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(TRUE);
    $objPHPExcel->getActiveSheet()->setCellValue('K5', 'Linea');
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(TRUE);
    $objPHPExcel->getActiveSheet()->setCellValue('L5', 'Area');
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(TRUE);
    $objPHPExcel->getActiveSheet()->setCellValue('M5', 'Nombre');

    $objPHPExcel->getActiveSheet()->setCellValue('N5', 'No. Maquina');
    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(TRUE);
    $objPHPExcel->getActiveSheet()->setCellValue('O5', 'Folio');
    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(TRUE);
    $objPHPExcel->getActiveSheet()->setCellValue('P5', 'Total');
    $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(TRUE);


    $objPHPExcel->getActiveSheet()->getStyle('A5:P5')->applyFromArray($estiloTituloColumnas);


    $fila = 6;

    while ($row = $resultado->fetch_assoc()) {
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, '' . ($fila - 5) . '');
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $row['estante']);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $row['descripcion']);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $row['clave']);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['maquina']);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['marca']);
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['modelo']);
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['cantidad']);
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['unidad_medida']);
        $objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $BE->fechaMxHora($row['fecha']));
        $objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['linea']);
        $objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $row['area']);
        $objPHPExcel->getActiveSheet()->setCellValue('M' . $fila, $row['nombre']);
        $objPHPExcel->getActiveSheet()->setCellValue('N' . $fila, $row['numeroMaquina']);
        $objPHPExcel->getActiveSheet()->setCellValue('O' . $fila, $row['folio_salida']);
        $objPHPExcel->getActiveSheet()->setCellValue('p' . $fila, $row['costo_total']);
        $fila++;
    }
    
    $fila = $fila - 1;
    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(TRUE);

    //Total 1
    $sentencia4 = 'SELECT sum(costo_total) AS importe FROM ' . $tipo . ' INNER JOIN refaccion ON ' . $tipo . '.ID_Refaccion = refaccion.ID_Refaccion WHERE fecha BETWEEN "' . $inicio .
            '" AND "' . $fin . ' 23:59:59" ORDER BY fecha DESC';
    $mysqli->set_charset("utf8");
    $resultado4 = $mysqli->query($sentencia4);
    while ($row = $resultado4->fetch_assoc()) {
        $objPHPExcel->getActiveSheet()->setCellValue('P' . ($fila + 1), $BE->darFormatoMoneda($row["importe"]));
    }


    $objPHPExcel->getActiveSheet()->setCellValue('O' . ($fila + 1), 'Total');
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "O" . ($fila + 1) . ":P" . ($fila + 1));
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacionNegritas, "O" . ($fila + 1) . ":P" . ($fila + 1));

    $objPHPExcel->getActiveSheet()->getStyle("A6:A" . $fila)->applyFromArray($estiloAmarrillo);
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "C6:P" . $fila);
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacionNegritas, "B6:C" . $fila);
}



$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(85);

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Disposition: attachment;filename="' . strtoupper($tipo) . '.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('php://output');
?>
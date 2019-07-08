<?php

//Incluimos librería y archivo de conexión
include_once '../Modelo/Modelo.php';
include_once '../Logica/BackEnd.php';
$BD = new BackEnd;

$fecha1 = $_GET["fecha1"];
$fecha2 = $_GET["fecha2"];

require 'Classes/PHPExcel.php';
require 'conexion.php';


//Consulta
$sql = "CALL vistaPedidos('$fecha1','$fecha2')";
$resultado = $mysqli->query($sql);
$fila = 7; //Establecemos en que fila inciara a imprimir los datos

$gdImage = imagecreatefrompng('imagesHera/logo.png'); //Logotipo
//Objeto de PHPExcel
$objPHPExcel = new PHPExcel();

//Propiedades de Documento
$objPHPExcel->getProperties()->setCreator("Hera/Sistemas")->setDescription("Reporte de Pedidos");

//Establecemos la pestaña activa y nombre a la pestaña
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("Pedidos");

$objDrawing = new PHPExcel_Worksheet_MemoryDrawing(); 
$objDrawing->setName('Logotipo');
$objDrawing->setDescription('Logotipo');
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(130);
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

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



$estiloPeriodo = array(
    'font' => array(
        'name' => 'Arial',
        'bold' => true,
        'italic' => false,
        'strike' => false,
        'size' => 11
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
);

$fecha = array(
    'font' => array(
        'name' => 'Arial',
        'bold' => FALSE,
        'italic' => false,
        'strike' => false,
        'size' => 10
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





$estiloAmarrillo = array(
    'font' => array(
        'name' => 'Arial',
        'bold' => FALSE,
        'size' => 10,
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
    )
);

$estiloazul = array(
    'font' => array(
        'name' => 'Arial',
        'bold' => FALSE,
        'size' => 10,
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '9bc2e6')
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


$informacion = array(
    'font' => array(
        'name' => 'Arial',
        'bold' => FALSE,
        'size' => 10,
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'fffff')
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




$objPHPExcel->getActiveSheet()->getStyle('A1:I3')->applyFromArray($estiloTituloReporte);
/* Fondo azul y blanco */



$objPHPExcel->getActiveSheet()->setCellValue('F2', 'REPORTE DE PEDIDOS');
$objPHPExcel->getActiveSheet()->mergeCells('C3:F3');

$objPHPExcel->getActiveSheet()->mergeCells('J1:L1');
$objPHPExcel->getActiveSheet()->getStyle('J1:L1')->applyFromArray($estiloPeriodo);
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'PERIODO');
$objPHPExcel->getActiveSheet()->mergeCells('J2:L2');
$objPHPExcel->getActiveSheet()->getStyle('J2:L2')->applyFromArray($estiloPeriodo);
$objPHPExcel->getActiveSheet()->setCellValue('J2',$fecha1.' AL '.$fecha2);

/**/



$fila = 6;

$count = 0;

while ($row = $resultado->fetch_assoc()) {


    $objPHPExcel->getActiveSheet()->getStyle('A' . $fila . ':L' . $fila . '')->applyFromArray($estiloAmarrillo);
    $objPHPExcel->getActiveSheet()->mergeCells('A' . $fila . ':C' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, 'PLACAS: ' . $row['Placa']);
    $objPHPExcel->getActiveSheet()->mergeCells('D' . $fila . ':F' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, 'TAXI: ' . $row['Taxi']);
    $objPHPExcel->getActiveSheet()->mergeCells('G' . $fila . ':I' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, 'LISTA: ' . $row['NombreConductor']);
    $objPHPExcel->getActiveSheet()->mergeCells('J' . $fila . ':L' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['FechaPedido']);


    $fila = $fila + 1;
    $objPHPExcel->getActiveSheet()->getStyle('A' . $fila . ':L' . $fila . '')->applyFromArray($estiloazul);
    $objPHPExcel->getActiveSheet()->mergeCells('A' . $fila . ':D' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, 'NOMBRE DEL PASAJERO');
    $objPHPExcel->getActiveSheet()->mergeCells('E' . $fila . ':F' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, 'CLAVE');
    $objPHPExcel->getActiveSheet()->mergeCells('G' . $fila . ':J' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, 'DESTINO');
    $objPHPExcel->getActiveSheet()->mergeCells('K' . $fila . ':L' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, 'COSTO');

    /* Contenido */
    $fila = $fila + 1;
    $objPHPExcel->getActiveSheet()->getStyle('A' . $fila . ':L' . $fila . '')->applyFromArray($informacion);
    $objPHPExcel->getActiveSheet()->mergeCells('A' . $fila . ':D' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $row['Nombre1']);
    $objPHPExcel->getActiveSheet()->mergeCells('E' . $fila . ':F' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['ClaveDestino1']);
    $objPHPExcel->getActiveSheet()->mergeCells('G' . $fila . ':J' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['Destino1']);
    $objPHPExcel->getActiveSheet()->mergeCells('K' . $fila . ':L' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['Costo1']);

    $fila = $fila + 1;
    $objPHPExcel->getActiveSheet()->getStyle('A' . $fila . ':L' . $fila . '')->applyFromArray($informacion);
    $objPHPExcel->getActiveSheet()->mergeCells('A' . $fila . ':D' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $row['Nombre2']);
    $objPHPExcel->getActiveSheet()->mergeCells('E' . $fila . ':F' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['ClaveDestino2']);
    $objPHPExcel->getActiveSheet()->mergeCells('G' . $fila . ':J' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['Destino2']);
    $objPHPExcel->getActiveSheet()->mergeCells('K' . $fila . ':L' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['Costo2']);


    $fila = $fila + 1;
    $objPHPExcel->getActiveSheet()->getStyle('A' . $fila . ':L' . $fila . '')->applyFromArray($informacion);
    $objPHPExcel->getActiveSheet()->mergeCells('A' . $fila . ':D' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $row['Nombre3']);
    $objPHPExcel->getActiveSheet()->mergeCells('E' . $fila . ':F' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['ClaveDestino3']);
    $objPHPExcel->getActiveSheet()->mergeCells('G' . $fila . ':J' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['Destino3']);
    $objPHPExcel->getActiveSheet()->mergeCells('K' . $fila . ':L' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['Costo3']);

    $fila = $fila + 1;
    $objPHPExcel->getActiveSheet()->getStyle('A' . $fila . ':L' . $fila . '')->applyFromArray($informacion);
    $objPHPExcel->getActiveSheet()->mergeCells('A' . $fila . ':D' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $row['Nombre4']);
    $objPHPExcel->getActiveSheet()->mergeCells('E' . $fila . ':F' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['ClaveDestino4']);
    $objPHPExcel->getActiveSheet()->mergeCells('G' . $fila . ':J' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['Destino4']);
    $objPHPExcel->getActiveSheet()->mergeCells('K' . $fila . ':L' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['Costo4']);

    $fila = $fila + 1;
    $objPHPExcel->getActiveSheet()->getStyle('A' . $fila . ':L' . $fila . '')->applyFromArray($informacion);
    $objPHPExcel->getActiveSheet()->mergeCells('A' . $fila . ':D' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $row['Nombre5']);
    $objPHPExcel->getActiveSheet()->mergeCells('E' . $fila . ':F' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['ClaveDestino5']);
    $objPHPExcel->getActiveSheet()->mergeCells('G' . $fila . ':J' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['Destino5']);
    $objPHPExcel->getActiveSheet()->mergeCells('K' . $fila . ':L' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['Costo5']);

    $fila = $fila + 1;
     $objPHPExcel->getActiveSheet()->getStyle('I' . $fila . ':L' . $fila . '')->applyFromArray($informacion);
    $objPHPExcel->getActiveSheet()->mergeCells('I' . $fila . ':J' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('I' . $fila,'SUBTOTAL');
    $objPHPExcel->getActiveSheet()->mergeCells('K' . $fila . ':L' . $fila . '');
    $objPHPExcel->getActiveSheet()->setCellValue('K' . $fila,$row["Costo1"]+$row["Costo2"]+$row["Costo3"]+$row["Costo4"]+$row["Costo5"]);
    
     $fila = $fila + 3;

    $count = $count + 1;
}








header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Disposition: attachment;filename="Registros.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('php://output');
?>
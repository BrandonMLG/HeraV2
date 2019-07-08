<?php

require 'Classes/PHPExcel.php';
require 'conexion.php';

$sql = "SELECT ID,Nombre,Nivel,SueldoBase,SueldoTarea,Departamento,Seccion,Puesto,Operacion,Ingreso,Sexo,Clasificacion FROM Empleado";
$resultado = $mysqli->query($sql);

$fila = 2;

	$estiloTituloReporte = array(
    'font' => array(
	'name'      => 'Arial',
	'bold'      => true,
	'italic'    => false,
	'strike'    => false,
	'size' =>13
    ),
    'fill' => array(
	'type'  => PHPExcel_Style_Fill::FILL_SOLID
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
	
	$estiloTituloColumnas = array(
    'font' => array(
	'name'  => 'Arial',
	'bold'  => true,
	'size' =>10,
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
    'alignment' =>  array(
	'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
	);
	
	$estiloInformacion = new PHPExcel_Style();
	$estiloInformacion->applyFromArray( array(
    'font' => array(
	'name'  => 'Arial',
	'color' => array(
	'rgb' => '000000'
	)
    ),
    'fill' => array(
	'type'  => PHPExcel_Style_Fill::FILL_SOLID
	),
    'borders' => array(
	'allborders' => array(
	'style' => PHPExcel_Style_Border::BORDER_THIN
	)
    ),
	'alignment' =>  array(
	'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
	));


$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Administrador")->setDescription("Reporte de Empleados");

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("Empleados");

$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Numero');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Nombre');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Nivel');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Sueldo Base');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Sueldo con Tarea');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Departamento');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Seccion');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Puesto');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Operacion');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Ingreso');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'Sexo');
$objPHPExcel->getActiveSheet()->setCellValue('L1', 'Clasificacion');

$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($estiloTituloColumnas);

while ($row = $resultado->fetch_assoc()) {

    $objPHPExcel->getActiveSheet()->setCellValue('A' . $fila, $row['ID']);
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $fila, $row['Nombre']);
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $fila, $row['Nivel']);
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $fila, $row['SueldoBase']);
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $fila, $row['SueldoTarea']);
    $objPHPExcel->getActiveSheet()->setCellValue('F' . $fila, $row['Departamento']);
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $fila, $row['Seccion']);
    $objPHPExcel->getActiveSheet()->setCellValue('H' . $fila, $row['Puesto']);
    $objPHPExcel->getActiveSheet()->setCellValue('I' . $fila, $row['Operacion']);
    $objPHPExcel->getActiveSheet()->setCellValue('J' . $fila, $row['Ingreso']);
    $objPHPExcel->getActiveSheet()->setCellValue('K' . $fila, $row['Sexo']);
    $objPHPExcel->getActiveSheet()->setCellValue('L' . $fila, $row['Clasificacion']);


    $fila++;
}
$fila = $fila-1;
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A2:L".$fila);

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Disposition: attachment;filename="Empleados.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('php://output');
?>
<?php
	
	require 'Classes/PHPExcel.php';
	require 'conexion.php';
	
	$sql = "SELECT ID_Log,Tipo,Evento,ID_Supervisor,Nombre,Fecha FROM log_db";
	$resultado = $mysqli->query($sql);
	
	$fila = 2;
	
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Administrador")->setDescription("Reporte de Registros");
	
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setTitle("Regi");
	
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID_Log');
	$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Tipo');
	$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Evento');
	$objPHPExcel->getActiveSheet()->setCellValue('D1', 'ID_Supervisor');
	$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Nombre');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Fecha');
	
	while($row = $resultado->fetch_assoc())
	{
		
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $row['ID_Log']);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $row['Tipo']);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $row['Evento']);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, $row['ID_Supervisor']);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, $row['Nombre']);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, $row['Fecha']);
		
		
		$fila++;
		
	}
	
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="Registros.xlsx"');
	header('Cache-Control: max-age=0');
	
	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	$objWriter->save('php://output');
	
?>
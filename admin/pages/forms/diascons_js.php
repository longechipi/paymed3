<?php
	require('../../conexion.php');
	$idmed = $_POST['idmed'];
	$dia = $_POST['dia'];
	/*  
	$fecha_actual = strtotime(date("Y-m-d"));
	$fecha_entrada = strtotime($fechaconsulta);
	//echo $fecha_actual.'--'.$fecha_entrada;	exit();
	if($fecha_entrada < $fecha_actual){
		echo '00'; exit();
	}*/
	/* ------------------------- -------------------------- ----------------------- --------------------*/
	$sql = ("SELECT dia, desde, hasta FROM  horariomed  where idmed='".$idmed."' AND dia='".$dia."';");

	$result=$mysqli->query($sql);
    $row_cnt = $result->num_rows;
	if($row_cnt>0){
		echo '1';
	}else{
		echo '0';
		//echo $dia.'--'.$mes.'--'.$ano.'->'.$row_cnt;
	}
?>
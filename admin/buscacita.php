<?php
	require('conexion.php');
	$dia = $_POST['dia'];$mes = $_POST['mes']+1;$ano = $_POST['ano'];
	$fechabusca=$ano.'-'.$mes.'-'.$dia;
	//echo $dia.'--'.$mes.'--'.$ano.'->'.$row_cnt;exit();
	$sql = ("SELECT idcita, fechacita, horacita, ampm, nombre, telefono, correo, comentario, importancia, tipo, respuesta, estatus FROM citas where fechacita = '".$fechabusca." ';");
	//echo $sql;exit();
	//$row_cnt =0;
	$result=$mysqli->query($sql);
    $row_cnt = $result->num_rows;
	if($row_cnt>0){
		echo '1';
		//echo $dia.'--'.$mes.'--'.$ano.'->'.$row_cnt;
	}else{
		echo '0';
		//echo $dia.'--'.$mes.'--'.$ano.'->'.$row_cnt;
	}
?>
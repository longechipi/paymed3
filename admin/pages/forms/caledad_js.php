<?php
	//require('../conf/conexion.php');
	//$fecha=date('Y-m-d');
	$fechanacimiento=$_POST['fecha'];
	//echo $fechanacimiento; exit();
	/*$fecha_nacimiento = $fnacimiento;
	$dia_actual = date("Y-m-d");
	$edad_diff = date_diff(date_create($fecha_nacimiento), date_create($dia_actual));
	echo gettype($edad_diff);*/
	list($ano,$mes,$dia) = explode("-",$fechanacimiento);
	$ano_diferencia  = date("Y") - $ano;
	$mes_diferencia = date("m") - $mes;
	$dia_diferencia   = date("d") - $dia;
	if ($dia_diferencia < 0 || $mes_diferencia < 0){
		$ano_diferencia--;
	}
	echo $ano_diferencia;
?>
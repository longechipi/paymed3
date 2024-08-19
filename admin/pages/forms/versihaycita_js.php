<?php
	date_default_timezone_set('America/Caracas');
	require('../../conexion.php');
	$idlogin = $_POST['idlogin'];
    $idmed = $_POST['idmed'];
	$fechacita = $_POST['fechacita'];
    $horacita = $_POST['horacita'];
    $day = date("l", strtotime($fechacita));
	switch ($day) {
		case "Sunday":
			   $dia = "Domingo";
		break;
		case "Monday":
				$dia = "Lunes";
		break;
		case "Tuesday":
				$dia = "Martes";
		break;
		case "Wednesday":
				$dia = "Miercoles";
		break;
		case "Thursday":
				$dia = "Jueves";
		break;
		case "Friday":
				$dia = "Viernes";
		break;
		case "Saturday":
				$dia = "Sabado";
		break;
	}
	/*$fecha_actual = strtotime(date("Y-m-d")); $fecha_entrada = strtotime($fechaconsulta);echo $fecha_actual.'--'.$fecha_entrada;	exit();
	if($fecha_entrada < $fecha_actual){	echo '00'; exit();} */
	/* ------------------------- -------------------------- ----------------------- --------------------*/
	$sql = ("SELECT dia, desde, hasta FROM  horariomed  where idmed='".$idmed."' AND dia='".$dia."';");
	$result=$mysqli->query($sql);$row_cnt = $result->num_rows;
	if($row_cnt == '0'){ // Virifica si es dia de consulta
		$hayono='0'; // No es dia de consulta
	}else{ // Si es dia de consulta, busco si hay cupo para la fehca y hora
		$sqlcita = ("SELECT idcita FROM  citas where idmed='".$idmed."' AND fechacita='".$fechacita."' AND horacita='".$horacita."';");
		$objcita=$mysqli->query($sqlcita);$row_cnt_cita = $objcita->num_rows;
		if($row_cnt_cita>0){
			$hayono='99';  // Fecha y Hora ocupada
		}else{
			$hayono='1';  // hay chance
		}
	}
	//echo $dia.'--'.$mes.'--'.$ano.'->'.$row_cnt;
	echo $hayono;
?>
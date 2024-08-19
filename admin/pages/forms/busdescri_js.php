<?php  // busco datos de los examenes, laboratorio
	require('../../conexion.php');
	date_default_timezone_set('America/Caracas');
	$idpac = $_POST['idpac'];$idcita = $_POST['idcita'];
	/* Busco idcita y idpaci, saber que tipo de examenes tiene */
	$sql = ("SELECT laboratorio, imagenologia, anatomia, interconsultas, otros FROM consultas_med WHERE  idcita='".$idcita."';");
	$obj = $mysqli->query($sql); $arr = $obj->fetch_array();
	$laboratorio = $arr['laboratorio'];
	$imagenologia = $arr['imagenologia'];
	$anatomia = $arr['anatomia'];
	$interconsultas = $arr['interconsultas'];
	$otros = $arr['otros'];
	$datos = array();
	$datos[] = array('laboratorio' => $laboratorio, 'imagenologia' => $imagenologia, 'anatomia' => $anatomia, 'interconsultas' => $interconsultas, 'otros' => $otros);
	echo json_encode($datos); exit();
?>
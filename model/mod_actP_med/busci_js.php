<?php
	require('../../conf/conexion.php');
	$cedula = $_POST['cedula'];
	$sql = ("SELECT idpaci FROM pacientes WHERE cedula = '$cedula';");
	$result=$mysqli->query($sql);
    $row_cnt = $result->num_rows;
	echo ($row_cnt > 0) ? '1' : '0';
?>
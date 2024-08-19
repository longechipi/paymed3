<?php
	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	$idaseg=$_POST['idaseg'];
	$idservaf=$_POST['idservaf'];
	/* Elimno el Servicio de la Aseguradora */
	$sql = ("DELETE FROM segurosserv WHERE idaseg='".$idaseg."'  AND idservaf='".$idservaf."'; ");
	$conex=$mysqli->query($sql);
	//$objesp=$mysqli->query($sql); $rowcounti=mysqli_num_rows($objesp);
	echo '1';
?>
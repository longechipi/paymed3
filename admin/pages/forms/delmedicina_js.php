<?php
	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	$idreg=$_POST['id'];
	/* Elimno Medicina */
	$sql = ("DELETE FROM consultas_trat WHERE idreg='".$idreg."'; ");
	$conex=$mysqli->query($sql);
	//$objesp=$mysqli->query($sql);  $rowcounti=mysqli_num_rows($objesp);
	echo '1';
?>
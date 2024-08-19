<?php
	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	$idcita=$_POST['idcita'];
	$observaciones=$_POST['observaciones'];

	/* Pulso Atras, actualizo el campo Observaciones */
	$strupdobser=("UPDATE consultas_med SET observaciones='".$observaciones."' WHERE idcita ='".$idcita."';");
	$obj=$mysqli->query($strupdobser); 
	//$rowcount=mysqli_num_rows($obj);$conex=$mysqli->query($sql);
	echo "1";
?>
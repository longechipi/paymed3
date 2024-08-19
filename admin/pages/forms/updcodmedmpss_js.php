<?php
	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	
	$idmed=$_POST['idmed'];
	$codcolemed=$_POST['codcolemed'];
	$mpsscod=$_POST['mpsscod'];
	/*Actualizo Codigo Colegio Medico y MPSS */
	$sql = ("UPDATE medicos SET codcolemed='".$codcolemed."', mpss='".$mpsscod."'
		WHERE idmed='".$idmed."'; ");
	$conex=$mysqli->query($sql);
	echo '1';
?>
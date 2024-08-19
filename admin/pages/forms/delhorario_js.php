<?php
	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	$idclinica=$_POST['idclinica'];
	$idmed=$_POST['idmed'];
	/*Borro en ClinicaMedico  */
	$sql = ("DELETE FROM clinicamedico WHERE idclinica='".$idclinica."'  AND idmed='".$idmed."'; ");
	$conex=$mysqli->query($sql); 
	/*Borro Horario del Medico En Clinica X */
	$sql = ("DELETE FROM horariomed WHERE idclinica='".$idclinica."'  AND idmed='".$idmed."'; ");
	$conex=$mysqli->query($sql); 
	echo '1';
	//$rowcount=mysqli_num_rows($objclimed);
?>
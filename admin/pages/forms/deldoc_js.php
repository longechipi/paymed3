<?php
	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	$id=$_POST['id'];
	//$idmed=$_POST['idmed'];
	/*Inserto tbl */
	$sql = ("DELETE FROM drdocument WHERE iddocument='".$id."'; ");
	
	$conex=$mysqli->query($sql);
?>
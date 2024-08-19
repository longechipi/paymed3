<?php

	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	$id=$_POST['id'];
	//$idmed=$_POST['idmed'];
	/*Inserto tbl */
	$sql = ("DELETE FROM medicos_esp WHERE idespxmed='".$id."'; ");
	
	$conex=$mysqli->query($sql);
    /*    */
	echo $id;
?>
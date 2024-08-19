<?php
	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	$idprov=$_POST['idprov'];
	$sql = ("UPDATE proveedores SET idestatus='1' WHERE idprov='".$idprov."'; ");
	$conex=$mysqli->query($sql);
	echo '1';
?>
<?php
	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	$idaseg=$_POST['iidaseg'];
	$idservaf=$_POST['idservaf'];
	/*Busco Si existe el Servicio*/
	$sqlbusca = ("SELECT idaseg, idservaf FROM segurosserv WHERE idaseg='".$idaseg."' AND idservaf='".$idservaf."'; ");
	$objbusca=$mysqli->query($sqlbusca); 
	$hay=mysqli_num_rows($objbusca);
	if ($hay!='0') {
		echo '1';
	}else{
		/* Elimno el Servicio de la Aseguradora */
		$sql = ("INSERT INTO segurosserv(idsegser, idaseg, idservaf, idestatus) VALUES (null, '".$idaseg."','".$idservaf."','1'); ");
		$conex=$mysqli->query($sql);
		//$objesp=$mysqli->query($sql); $rowcounti=mysqli_num_rows($objesp);
		echo '0';
	}
?>
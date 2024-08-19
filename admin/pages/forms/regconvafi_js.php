<?php
	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	$id=$_POST['id'];
	$idmed=$_POST['idmed'];
	/*inserto idmed y id del convenio de afiliacion */
	$sql = ("SELECT idconvafi FROM convafixmedico WHERE idservaf='".$id."'	AND idmed='".$idmed."'; ");
	
	$objesp=$mysqli->query($sql);
	$rowcounti=mysqli_num_rows($objesp);

	if ($rowcounti>0) {
		// borrar
		$sql="DELETE FROM convafixmedico WHERE idservaf='".$id."'	AND idmed='".$idmed."'; ";
	}else{
		/*Inserto */
		$sql = ("INSERT INTO convafixmedico(idconvafi, idmed, idservaf, idestatus) 
		VALUES ( null,'".$idmed."','".$id."', '1'); ");
	}
	
	$conex=$mysqli->query($sql);
?>
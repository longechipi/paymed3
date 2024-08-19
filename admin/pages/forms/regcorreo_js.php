<?php
	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	$correo=$_POST['correo'];
	/*Inserto tbl */
	//$sql = ("SELECT count(*) as esta, idprovesp, idprov, idespmed FROM provesp WHERE idprov='".$idprov."' AND idespmed='".$idesp."'; ");
	//$obj=$mysqli->query($sql); $arr=$obj->fetch_array();
    $sql = ("UPDATE correosendinfmed SET correo='".$correo."' WHERE 1");
    $conex=$mysqli->query($sql);
    echo 'D';
?>
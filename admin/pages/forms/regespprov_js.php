<?php
	require('../../conexion.php');
	//$fecha=date('Y-m-d');
	$idprov=$_POST['idprov'];
	$idesp=$_POST['id'];
	/*Inserto tbl */
	$sql = ("SELECT count(*) as esta, idprovesp, idprov, idespmed FROM provesp WHERE idprov='".$idprov."' AND idespmed='".$idesp."'; ");
	
	$obj=$mysqli->query($sql); $arr=$obj->fetch_array(); 
    $esta=$arr[0];
    if ($esta!='0') {
    	$sql = ("DELETE FROM provesp WHERE idprov='".$idprov."' AND idespmed='".$idesp."'; ");
    	$conex=$mysqli->query($sql);
    	echo 'D';
    }else{
    	$sql = ("INSERT INTO provesp(idprovesp, idprov, idespmed, idestatus) VALUES (null,'".$idprov."', '".$idesp."','1'); ");
    	$conex=$mysqli->query($sql);
    	echo 'I';
    }
?>
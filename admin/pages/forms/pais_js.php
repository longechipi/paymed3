<?php
	//include "users/conn.php";
	require('../../conexion.php');
	
	$db=connect();
	//$str=("select id, idestado, idpais, estado, estatus from estado where idpais=$_GET[idpais]");echo $str; exit();

	$query=$db->query("select idestado, estado from estado where idpais=$_GET[idpais] AND idestatus='1';");

	$states = array();
	while($r=$query->fetch_object()){ $states[]=$r; }
	
		if(count($states)>0){
			print "<option value=''>-- SELECCIONE --</option>";
			foreach ($states as $s) {
				print "<option value='$s->idestado'>$s->estado</option>";
			}
		}else{
			print "<option value=''>-- NO HAY DATOS --</option>";
		}
?>
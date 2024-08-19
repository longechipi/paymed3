<?php
	//include "users/conn.php";
	require('../../conexion.php');
	//include "conect_domic.php";
	$db=connect();
	//$str="SELECT a.idservaf, a.servicio FROM serviciosafiliados a	WHERE a.idservaf NOT IN(select b.idservaf FROM segurosserv b WHERE b.idaseg=$_GET[idaseg]);";echo $str; exit();
	
	$query=$db->query("SELECT a.idservaf, a.servicio FROM serviciosafiliados a
						WHERE a.idservaf NOT IN(select b.idservaf FROM segurosserv b WHERE b.idaseg=$_GET[idaseg]);");

	$states = array();
	while($r=$query->fetch_object()){ $states[]=$r; }
		if(count($states)>0){
			print "<option value=''>-- SELECCIONE --</option>";
			foreach ($states as $s) {
				print "<option value='$s->idservaf'>$s->servicio</option>";
			}
		}else{
			print "<option value=''>-- NO HAY DATOS --</option>";
		}
?>
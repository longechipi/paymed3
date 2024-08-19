<?php
	//include "users/conn.php";
	require('../../conexion.php');
	//include "conect_domic.php";
	$db=connect();
	//$str="select * from municipios where idestado=$_GET[id_estado]";echo $str; exit();
	// ND $query=$db->query("SELECT b.idservaf, b.servicio FROM segurosserv a, serviciosafiliados b WHERE a.idservaf=b.idservaf	AND a.idaseg=$_GET[idaseg]");
	$query=$db->query("SELECT b.idservaf, b.servicio FROM asegurador_servicios a, serviciosafiliados b WHERE a.idserv=b.idservaf 
		AND a.idaseg=$_GET[idaseg]");

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
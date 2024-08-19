<?php
	//include "users/conn.php";
	require('../../conexion.php');
	
	$db=connect();
	//$str=("SELECT a.idmed ,CONCAT(a.apellido1,' ', a.nombre1) AS nombre FROM medicos a, clinicass b, clinicamedico c WHERE a.idmed = $_GET[idcli] and c.idclinica=b.idclinica and c.idmed=a.idmed AND a.idestatus='1';;");echo $str; exit();
	//$query=$db->query("SELECT a.idclinica, a.razsocial FROM clinicas a, aseguradores b, clinicaseguros c
	//WHERE b.idaseg =$_GET[idseguro] and a.idclinica=c.idclinica and b.idaseg=c.idaseg AND a.idestatus='1';");
	$query=$db->query("SELECT c.idespmed, c.especialidad
	FROM medicos a, medicos_esp b, especialidadmed c
	WHERE a.idmed=$_GET[idmed]
	and a.idmed=b.idmed
	and b.idespmed=c.idespmed
	and a.idestatus='1';");

	$states = array();
	while($r=$query->fetch_object()){ $states[]=$r; }
	
		if(count($states)>0){
			print "<option value=''>-- SELECCIONE --</option>";
			foreach ($states as $s) {
				print "<option value='$s->idespmed'>$s->especialidad</option>";
			}
		}else{
			print "<option value=''>-- NO HAY DATOS --</option>";
		}
?>
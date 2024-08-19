<?php
	//include "users/conn.php";
	require('../../conexion.php');
	
	$db=connect();
	//$str=("SELECT a.idclinica, a.razsocial FROM clinicas a, aseguradores b, clinicaseguros cWHERE c.idclinica=$_GET[idseguro] and a.idclinica=c.idclinica and b.idaseg=c.idaseg AND a.idestatus='1';");;echo $str; exit();	
	
	$query=$db->query("SELECT a.idclinica, a.razsocial FROM clinicas a, aseguradores b, clinicaseguros c
	WHERE b.idaseg =$_GET[idseguro] and a.idclinica=c.idclinica and b.idaseg=c.idaseg AND a.idestatus='1';");

	$states = array();
	while($r=$query->fetch_object()){ $states[]=$r; }
	
		if(count($states)>0){
			print "<option value=''>-- SELECCIONE --</option>";
			foreach ($states as $s) {
				print "<option value='$s->idclinica'>$s->razsocial</option>";
			}
		}else{
			print "<option value=''>-- NO HAY DATOS --</option>";
		}
?>
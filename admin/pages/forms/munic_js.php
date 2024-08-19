<?php
	//include "users/conn.php";
	require('../../conexion.php');
	//include "conect_domic.php";
	$db=connect();
	//$str="select * from municipios where idestado=$_GET[id_estado]";echo $str; exit();
	$query=$db->query("SELECT idparroquia, parroquia FROM parroquias WHERE idmunicipio=$_GET[id_municipio] AND idestatus='1';");

	$states = array();
	while($r=$query->fetch_object()){ $states[]=$r; }
		if(count($states)>0){
			print "<option value=''>-- SELECCIONE --</option>";
			foreach ($states as $s) {
				print "<option value='$s->idparroquia'>$s->parroquia</option>";
			}
		}else{
			print "<option value=''>-- NO HAY DATOS --</option>";
		}
?>
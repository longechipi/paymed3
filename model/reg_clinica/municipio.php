<?php
	require('../../conf/conexion.php');
	$query = $mysqli -> query("SELECT idparroquia, parroquia FROM parroquias WHERE idmunicipio=$_GET[id_municipio] AND idestatus='1';");
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
<?php
	require('../../conf/conexion.php');
	$query = $mysqli -> query("select * from municipios where idestado=$_GET[id_estado]");
	$states = array();
	while($r=$query->fetch_object()){ $states[]=$r; }
		if(count($states)>0){
			print "<option value=''>-- SELECCIONE --</option>";
			foreach ($states as $s) {
				print "<option value='$s->idmunicipio'>$s->municipio</option>";
			}
		}else{
			print "<option value=''>-- NO HAY DATOS --</option>";
		}
?>
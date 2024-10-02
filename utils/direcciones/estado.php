<?php
	require('../../conf/conexion.php');
	$pais = $_GET['idpais'];
	$query = $mysqli -> query("SELECT idestado, estado FROM estado WHERE idpais= $pais AND idestatus='1';");
	$states = array();
	while($r=$query->fetch_object()){ $states[]=$r; }
		if(count($states)>0){
			print "<option value='' disabled selected>Seleccionar</option>";
			foreach ($states as $s) {
				print "<option value='$s->idestado'>$s->estado</option>";
		    }
		}else{
			print "<option value=''>-- NO HAY DATOS --</option>";
		}
?>
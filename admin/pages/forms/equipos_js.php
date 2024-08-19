<?php
	include('conn.php');
	$db=connect();
	$query=$db->query("SELECT idpreq, equipo, costo FROM proveedores_equipos WHERE idprov=$_GET[id_eq] ORDER BY equipo ASC");
	$states = array();
	while($r=$query->fetch_object()){ $states[]=$r; }
		if(count($states)>0){
			print "<option value=''>-- SELECCIONE --</option>";
			foreach ($states as $s) {
				print "<option value='$s->idpreq'>$s->equipo</option>";
			}
		}else{
			print "<option value=''>-- NO HAY DATOS --</option>";
		}
?>
<?php
	//include "users/conn.php";
	require('../../conexion.php');
	//include "conect_domic.php"; SELECT codserv, servicio FROM `servimage` GROUP BY 1,2;
	$db=connect();
	//$str="SELECT codzona, zona FROM servimage  WHERE codserv=$_GET[codserv]	GROUP BY 1,2;";echo $str; exit();
	$query=$db->query("SELECT codzona, zona FROM servimage  WHERE codserv=$_GET[codserv]	GROUP BY 1,2;");

	$states = array();
	while($r=$query->fetch_object()){ $states[]=$r; }
		if(count($states)>0){
			print "<option value=''>-- SELECCIONE --</option>";
			foreach ($states as $s) {
				print "<option value='$s->codzona'>$s->zona</option>";
			}
		}else{
			print "<option value=''>-- NO HAY DATOS --</option>";
		}
?>
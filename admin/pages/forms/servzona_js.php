<?php
	//include "users/conn.php";
	require('../../conexion.php');
	$db=connect();
	//$str=("SELECT codserv, servicio, codzona, zona  FROM servimage  WHERE codserv =$_GET[codserv] AND idestatus='1';");echo $str; exit();
	$query=$db->query("SELECT codestudio, estudio  FROM servimage 
                       WHERE codzona =$_GET[codzona] AND idestatus='1' GROUP BY 1,2;");
	$states = array();
	while($r=$query->fetch_object()){ $states[]=$r; }
	
		if(count($states)>0){
			print "<option value=''>-- SELECCIONE --</option>";
			foreach ($states as $s) {
				print "<option value='$s->codestudio'>$s->estudio</option>";
			}
		}else{
			print "<option value=''>-- NO HAY DATOS --</option>";
		}
?>
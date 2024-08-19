<?php
	require('../../conexion.php');
	if(isset($_GET['idlin'])){
		$idlin=$_GET['idlin'];
		$idpac=$_GET['idpac'];
		$sql="DELETE FROM presupuesto_vias_abordaje WHERE idviabordaje ='".$idlin."'";
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!");
				window.location.href="updpresu_vias_abordaje.php?idpac='.$idpac.'"; </script>';
	} 
?>
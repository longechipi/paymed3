<?php
	require('../../conexion.php');
	if(isset($_GET['idlin'])){
		$idlin=$_GET['idlin'];
		$idpac=$_GET['idpac'];
		$sql="DELETE FROM presupuesto_proveedores WHERE idpreprov ='".$idlin."'";
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!");
				window.location.href="updpresu_casa_comercial.php?idpac='.$idpac.'"; </script>';
	} 
?>
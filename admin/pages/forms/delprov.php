<?php
	require('../../conexion.php');
	if(isset($_GET['id'])){
		$idprov=$_GET['id'];
		$sql="DELETE FROM proveedores WHERE idprov='".$idprov."' ";
		//echo $sql;exit();
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="rpt_prov.php"; </script>';
	} 
?>
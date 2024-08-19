<?php
	require('../../conexion.php');
	if(isset($_GET['idcontacto'])){
		$idcontacto=$_GET['idcontacto'];
		$sql="DELETE FROM tipocontacto WHERE idtipocontacto='".$idcontacto."'";
		//echo $sql;exit();
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="rpt_tipocontacto.php"; </script>';
	} 
?>
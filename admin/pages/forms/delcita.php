<?php
	require('../../conexion.php');
	if(isset($_GET['idc'])){
		$idc=$_GET['idc'];
		//
		$sql="DELETE FROM consultas_med WHERE idcita='".$idc."' ";
		$query=$mysqli->query($sql);

		$sql="DELETE FROM consultas_trat WHERE idcita='".$idc."' ";
		$query=$mysqli->query($sql);

		$sql="DELETE FROM citas WHERE idcita='".$idc."' ";
		//echo $sql;exit();
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="rpt_citas.php"; </script>';
	} 
?>
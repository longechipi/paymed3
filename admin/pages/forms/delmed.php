<?php
	require('../../conexion.php');
	if(isset($_GET['id'])){
		$idmed=$_GET['id'];
		$sql="DELETE FROM medicos WHERE idmed='".$idmed."' ";
		//echo $sql;exit();
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="rpt_med.php"; </script>';
	} 
?>
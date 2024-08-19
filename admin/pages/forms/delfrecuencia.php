<?php
	require('../../conexion.php');
	if(isset($_GET['idfrecuencia'])){
		$idfrecuencia=$_GET['idfrecuencia'];
		$sql="DELETE FROM frecuenciapago WHERE idfq='".$idfrecuencia."'";
		// echo $sql;exit();
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="rpt_frecuencia.php"; </script>';
	} 
?>
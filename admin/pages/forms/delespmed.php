<?php
	require('../../conexion.php');
	if(isset($_GET['idespm'])){
		$idespm=$_GET['idespm'];
		$sql="DELETE FROM presupuesto_especialidades WHERE idesppresu='".$idespm."' ";
		//echo $sql;exit();
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="rpt_espmed.php"; </script>';
	} 
?>
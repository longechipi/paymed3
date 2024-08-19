<?php
	require('../../conexion.php');
	if(isset($_GET['idec'])){
		$idec=$_GET['idec'];
		$sql="DELETE FROM estadocivil WHERE idecivil='".$idec."' ";
		//echo $sql;exit();
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="rpt_estadocivil.php"; </script>';
	} 
?>
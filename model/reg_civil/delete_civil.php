<?php
require('../../conf/conexion.php');
	if(isset($_GET['idec'])){
		$idec=$_GET['idec'];
		$sql="DELETE FROM estadocivil WHERE idestcivil='".$idec."' ";
		//echo $sql;exit();
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="../../html/rpt_estadocivil.php"; </script>';
	} 
?>
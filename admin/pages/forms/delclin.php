<?php
	require('../../conexion.php');
	if(isset($_GET['id'])){
		$idclinica=$_GET['id'];
		$sql="DELETE FROM clinicas WHERE idclinica='".$idclinica."' ";
		//echo $sql;exit();
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="rpt_clin.php"; </script>';
	} 
?>
<?php
	require('../../conexion.php');
	if(isset($_GET['idp'])){
		$idp=$_GET['idp'];
		$sql="DELETE FROM regpagos WHERE idpagos='".$idp."' ";
		//echo $sql;exit();
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="rpt_regpago.php"; </script>';
	} 
?>
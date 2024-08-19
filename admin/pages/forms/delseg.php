<?php
	require('../../conexion.php');
	if(isset($_GET['id'])){
		$idaseg=$_GET['id'];
		$sql="DELETE FROM aseguradores WHERE idaseg='".$idaseg."' ";
		//echo $sql;exit();
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="rpt_seg.php"; </script>';
	} 
?>
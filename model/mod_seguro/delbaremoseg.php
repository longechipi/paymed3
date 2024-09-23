<?php
	require('../../conf/conexion.php');
	if(isset($_GET['idlin'])){
		$idcconta=$_GET['idlin'];
		$idseguro=$_GET['idseg'];
		$sql="DELETE FROM asegura_negocia WHERE idneg='".$idcconta."' ";
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!");
				window.location.href="../../html/updsegbaremo.php?id='.$idseguro.'"; </script>';
	} 
?>
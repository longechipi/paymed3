<?php
	require('../../conexion.php');
	if(isset($_GET['idlin'])){
		$idcconta=$_GET['idlin'];
		$idseguro=$_GET['idseg'];
		$sql="DELETE FROM aseguradores_contacto WHERE idcontacto='".$idcconta."' ";
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!");
				window.location.href="updsegcontacto.php?id='.$idseguro.'"; </script>';
	} 
?>
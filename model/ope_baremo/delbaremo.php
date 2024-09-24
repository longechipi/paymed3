<?php
	require('../../conf/conexion.php');
	if(isset($_GET['idlin'])){
		$idbare=$_GET['idlin'];
		$sql="DELETE FROM baremos_paymed WHERE idbaremo = $idbare";
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!"); window.location.href="../../html/baremo_paymed.php"; </script>';
	} 
?>
<?php
require('../../conf/conexion.php');
if(isset($_GET['idbk'])){
		$idbk=$_GET['idbk'];
		$sql="DELETE FROM bancos WHERE idbco='".$idbk."' ";
		//echo $sql;exit();
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="../../html/rpt_bancos.php"; </script>';
	} 
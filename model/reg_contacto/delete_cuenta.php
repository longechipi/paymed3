<?php
require('../../conf/conexion.php');
if(isset($_GET['idcontacto'])){
		$idcontacto=$_GET['idcontacto'];
		$sql="DELETE FROM tipocontacto WHERE idtipocontacto='".$idcontacto."'";
		$query=$mysqli->query($sql);
        echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="../../html/rpt_tipocontacto.php"; </script>';
	} 
?>
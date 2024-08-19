<?php
	require('../../conexion.php');
	if(isset($_GET['idcatblg'])){
		$idcatblg=$_GET['idcatblg'];
		$sql="delete from blog_categories where idcateg='".$idcatblg."' ";
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="rpt_catebl.php"; </script>';
	} 
?>
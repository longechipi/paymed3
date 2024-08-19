<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');
	if(isset($_GET['idm'])){
		$idmed=$_GET['idm'];
		$idlogin=$_GET['idl'];
		$sql = ("UPDATE  medicos SET idestatus='3' WHERE idmed='".$idmed."';");
	    $obj=$mysqli->query($sql); //$arr=$obj->fetch_array();
	    $str="UPDATE loginn SET estatus='I' WHERE idlogin='".$idlogin."'";
		$conexion=$mysqli->query($str);
	}else{
		echo '<script language="javascript">window.location.href="../../../login.html"; </script>';
	}
	echo '<script language="javascript">alert("¡Medico Rechazado!");window.location.href="rpt_apromed.php"; </script>';
	
?>
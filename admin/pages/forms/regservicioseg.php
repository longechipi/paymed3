<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');

		$nocli    =$_POST['nocli'];
		$servi    =$_POST['servi'];
		$canti    =$_POST['canti'];
		$monto    =$_POST['monto'];
		$periodo  =$_POST['periodo'];

	$str="INSERT INTO asegurador_servicios (idaseg, idserv, cantidad, monto, periodo) 
		VALUES ('".$nocli."','".$servi."','".$canti."','".$monto."','".strtoupper($periodo)."')";
		$conexion=$mysqli->query($str);

		echo '<script language="javascript">//alert("¡Registro Exitoso!");
			                                window.location.href="updsegservicios.php?id='.$nocli.'"; </script>';
?>	
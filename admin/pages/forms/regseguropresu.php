<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');

		$idpresu =$_POST['idpresu'];
		$idaseg  =$_POST['idaseg'];
		$npol    =$_POST['npol'];
		$idpaci  =$_POST['idpaci'];
		
	$str="INSERT INTO presupuesto_seguros 
					   (idpresupuesto, 
						idaseg, 
						nro_poliza) 
		   		VALUES ('".$idpresu."',
		   				'".$idaseg."',
		   				'".$npol."')";
		$conexion=$mysqli->query($str);

		echo '<script language="javascript">//alert("¡Registro Exitoso!");
			        window.location.href="updpresu_seguros.php?idpac='.$idpaci.'"; 
			  </script>';
?>		
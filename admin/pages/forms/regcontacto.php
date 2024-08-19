<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');

		$nocli     =$_POST['nocli'];
		$contacto1 =$_POST['contacto1'];
		$coda      =$_POST['coda'];
	    $telefono  =$coda.''.$_POST['telefono'];
		$correo1   =$_POST['correo1'];
		$cargo1    =$_POST['cargo1'];
		$dpto1     =$_POST['dpto1'];

	$str="INSERT INTO clinicas_contacto (idclinica, contacto, cargo, telefono, correo, dpto) 
		VALUES ('".$nocli."','".strtoupper($contacto1)."','".$cargo1."','".strtoupper($telefono)."','".strtoupper($correo1)."','".strtoupper($dpto1)."')";
		$conexion=$mysqli->query($str);

		echo '<script language="javascript">//alert("¡Registro Exitoso!");
			                                window.location.href="updclicontacto.php?id='.$nocli.'"; </script>';
?>		
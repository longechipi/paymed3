<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');

		$idpresu =$_POST['idpresu'];
		$idq     =$_POST['idq'];
		$equip   =$_POST['equip'];
		$idpaci  =$_POST['idpaci'];

				$c=0; 
				$str="INSERT INTO presupuesto_proveedores 
								   (idpresupuesto, 
								   	idprov,
									idpreq) 
					   		VALUES ('".$idpresu."',
					   				'".$idq."',
					   				'".$equip."')";
					$conexion=$mysqli->query($str);

					echo '<script language="javascript">//alert("¡Registro Exitoso!");
						        window.location.href="updpresu_casa_comercial.php?idpac='.$idpaci.'"; 
						  </script>';
			


?>		
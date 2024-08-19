<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');

		$nocli      =$_POST['nocli'];
		$desde      =$_POST['desde'];
		$hasta      =$_POST['hasta'];
		$descb      ='Baremo (desde: '.$desde. ' hasta: ' .$hasta.')';
		$tpbaremo   =$_POST['tpbaremo'];
		$baremodesc =$_POST['baremodesc'];

		$imagen2 = '';
		if(!empty($_FILES["imagen_des"]["type"])){
			$fileName = time().'_'.$_FILES['imagen_des']['name'];
			$valid_extensions = array("jpg", "png", "jpeg", "pdf");
			$temporary = explode(".", $_FILES["imagen_des"]["name"]);
			$file_extension = end($temporary);
	if(((($_FILES["imagen_des"]["type"] == "application/pdf")) && in_array($file_extension, $valid_extensions))) {
				$sourcePath = $_FILES['imagen_des']['tmp_name'];
				$targetPath = "imgdocs/".$fileName;
				if(move_uploaded_file($sourcePath,$targetPath)){
					$imagen2 = $fileName;
				}
			}
		}

	$str="UPDATE asegura_negocia SET idestatus='2' WHERE idaseg='".$nocli."'";
		$conexion=$mysqli->query($str);

	$str="INSERT INTO asegura_negocia (idaseg, descripcion, validodesde, validohasta, archivo, tipobaremo, descbaremo, idestatus) 
		VALUES ('".$nocli."','".strtoupper($descb)."','".$desde."','".$hasta."','".$imagen2."','".$tpbaremo."','".$baremodesc."','1')";
		$conexion=$mysqli->query($str);

		echo '<script language="javascript">//alert("¡Registro Exitoso!");
			                                window.location.href="updsegbaremo.php?id='.$nocli.'"; </script>';
?>	
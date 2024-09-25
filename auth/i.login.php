<?php
require('../conf/conexion.php');
include('../layouts/header.php');

$usuario = $_POST['usuario'];
$pass    = $_POST['clave'];

if(empty($usuario) || empty($pass)){
	//header("Location: index.html"); exit(); 
	echo "AQUIII";
}

$sql=("SELECT * from loginn WHERE correo='".strtolower($usuario)."'");

$conexion1=$mysqli->query($sql);
$datos=$conexion1->fetch_array();


if($datos['correo'] == $usuario & $datos['clave'] == $pass){
	if($datos['cargo'] =='Medico'){ //Verifico Si es medico y si pago
  		$sqlactivo=("SELECT count(*) as hay from medicos WHERE correo='$usuario' AND idestatus='3'; ");
  		$objactivo=$mysqli->query($sqlactivo);
  		$arractivo=$objactivo->fetch_array();
  		if($arractivo[0]!='0'){
  			echo '<script language="javascript">alert("Error: Sin Pago Realizado");window.location.href="../index.html";</script>';exit();	
  		}
		
			
  	}

		session_start();
		@$_SESSION['usuario'] 		= $usuario;
		@$_SESSION['idlogin'] 		= $datos['idlogin'];
		@$_SESSION['privilegios'] 	= $datos['privilegios'];
	  	@$_SESSION['correouso'] 	= $datos['correo'];
		@$_SESSION['cargo'] 		= $datos['cargo'];
		@$_SESSION['imagen'] 		= $datos['imagen'];
		

		$permisos=$datos['privilegios'];

		if($permisos == 1){ 
			echo '<script language="javascript">window.location.href="../html/index2.php?usr=1";</script>';
        }
			
		elseif($permisos != 1 ){ 
			if($datos['clave']=='123'){
				echo '<script language="javascript">window.location.href="../admin/cambio_clave.php";</script>';
			}else{
				if ( $permisos == 7) {// Es Asistente
					require('selemedico.php');
				}
				echo '<script language="javascript">window.location.href="../html/index2.php?usr=1";</script>';}

		} elseif($datos['estatus'] == 'I'){
			echo '<script>
				Swal.fire({
					icon: "error",
					title: "Error de Conexión",
					text:"El Usuario se Encuentra Inactivo",
					confirmButtonText: "Volver",
					confirmButtonColor: "#005e43",
					}).then(function() {
						window.location.href = "../index.html";
					});
				</script>';

  		} else{
			echo '<script>
				Swal.fire({
					icon: "error",
					title: "Error de Conexión",
					text:"Error en la Contraseña o Usuario no Existe, por favor Verifique",
					confirmButtonText: "Volver",
					confirmButtonColor: "#005e43",
					}).then(function() {
						window.location.href = "../index.html";
					});
				</script>';
		}
	}else{	 
		echo '<script>
		  Swal.fire({
		  	icon: "error",
		   	title: "Error de Conexión",
			text:"Error en la Contraseña o Usuario no Existe, por favor Verifique",
		   	confirmButtonText: "Volver",
		   	confirmButtonColor: "#005e43",
		   	}).then(function() {
				window.location.href = "../index.html";
			});
		  </script>';
	}
?>
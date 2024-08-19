<?php
require('../admin/conexion.php');

$usuario = $_POST['usuario'];
$pass    = $_POST['clave'];

//echo $usuario.' - '.$pass; exit();

if(empty($usuario) || empty($pass)){
	header("Location: index.html"); exit(); 
}

// $sql=("SELECT * from loginn WHERE usuario='$usuario' ");
$sql=("SELECT * from loginn WHERE correo='".strtolower($usuario)."'");


$conexion1=$mysqli->query($sql);
$datos=$conexion1->fetch_array();

//if($datos['usuario'] == $usuario & $datos['clave'] == $pass){
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
			echo '<script language="javascript">window.location.href="../admin/index.php?usr=1";</script>';
        }
			
		elseif($permisos != 1 ){ 

			if($datos['clave']=='123'){
				echo '<script language="javascript">window.location.href="../admin/cambio_clave.php";</script>';
			}else{
				if ( $permisos == 7) {// Es Asistente
					require('selemedico.php');
				}
				echo '<script language="javascript">window.location.href="../admin/index.php?usr=1";</script>';}

	} elseif($datos['estatus'] == 'I'){
			echo '<script language="javascript">alert("USUARIO INACTIVO");window.location.href="../index.html";</script>'; 
			exit();

  } else{
	  	echo '<script language="javascript">alert("USUARIO ó CLAVE INCORRECTO, VERIFIQUE SUS DATOS");window.location.href="../index.html";</script>'; 
	  	exit(); }
	}else{
		echo '<script language="javascript">alert("USUARIO/CLAVE NO EXISTE");window.location.href="../index.html";</script>'; 
	}

?>
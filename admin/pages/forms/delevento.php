<?php	
	session_start();
	require('../../conexion.php');
	if(!isset($_SESSION['usuario'])){
		echo '<script language="javascript">
		window.location.href="../../index.php";</script>'; 
		exit();
	}
	$usuario = $_SESSION['usuario'];
	$idcita=$_GET['idcita'];
	//busco campos q necesito grabar en la bitacora (inmuebles_r)
	$sql="SELECT nombre FROM citas WHERE idcita='".$idcita."' ";
	$query=$mysqli->query($sql);	
	$arr_citas = mysqli_fetch_array($query);
	$nombre=$arr_citas[0];
	// Inserta en tabla de auditoria(inmuebles_r)
	$str="INSERT INTO inmuebles_r(id, codinm, titulo, modulo, usuario, accion) VALUES ('".$idcita."','0','".$nombre."','CITAS','".$usuario."', 'E');";
	$conexion=$mysqli->query($str);
	//echo $str; exit();
	
	if(isset($_GET['idcita'])){
		$idcita=$_GET['idcita'];
		//echo $idasesor.' '; //exit();
		$sql="delete from citas where idcita='".$idcita."' ";
		//echo $sql;exit();
		$query=$mysqli->query($sql);	
		// $arr_asesor = mysqli_fetch_array($query);
		echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="rpt_agenda.php"; </script>';
	}
?>

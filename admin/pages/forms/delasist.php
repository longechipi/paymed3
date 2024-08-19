<?php session_start();
	require('../../conexion.php');
	$idloginmed = $_SESSION['idlogin'];
	$sqlmed = ("SELECT idmed from medicos WHERE idlogin='".$idloginmed."'");
    $objmed=$mysqli->query($sqlmed); $arrmed=$objmed->fetch_array();  
    $idmed=$arrmed[0];

	if(isset($_GET['xy'])){
		$id=$_GET['xy'];
		//$sql="DELETE FROM loginn WHERE idlogin='".$id."' ";
		$sql="DELETE FROM medicosxasist
		WHERE idasist='".$id."' and idmed='".$idmed."'; ";
		//echo $sql;exit();
		$query=$mysqli->query($sql);	
		echo '<script language="javascript">alert("¡Registro Eliminado!");window.location.href="rpt_asist.php"; </script>';
	} 
?>
<?php 
require('../../conf/conexion.php');
$estadocivil = $_POST['estadocivil'];
$estatus = $_POST['estatus'];
$str = "INSERT INTO estadocivil(estcivil,idestatus) VALUES ('" .ucfirst( $estadocivil) . "','" . $estatus . "')";
$conexion = $mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
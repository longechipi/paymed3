<?php 
require('../../conf/conexion.php');
$idservi = $_POST['idservi'];
$servicio = $_POST['servicio'];
$estatus = $_POST['estatus'];
$str = "UPDATE serviciosafiliados SET servicio='".ucfirst($servicio)."', idestatus='".$estatus."' WHERE idservaf= '".$idservi."'";
$conexion = $mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
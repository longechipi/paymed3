<?php 
require('../../conf/conexion.php');
$idespmed = $_POST['idespmed'];
$especialidad = $_POST['especialidad'];
$estatus = $_POST['estatus'];
$str = "UPDATE especialidadmed SET especialidad='".strtoupper($especialidad)."', idestatus = '".$estatus."' WHERE idespmed = '".$idespmed."'";
$conexion = $mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
<?php
require('../../conf/conexion.php');
$servicios = $_POST['servicios'];
$estatus = $_POST['estatus'];
$str="INSERT INTO serviciosafiliados(servicio,idestatus) VALUES ('".ucfirst($servicios)."','".$estatus."')";
$conexion=$mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
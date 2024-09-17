<?php 
require('../../conf/conexion.php');
$tipoprov = $_POST['tipoprov'];
$idestatus = $_POST['idestatus'];

$str = "INSERT INTO tipoproveedor( tipoprov, idestatus) VALUES ('".$tipoprov."', '".$idestatus."'); ";
$conexion = $mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}

?>
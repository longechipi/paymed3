<?php 
require('../../conf/conexion.php');

$bancos  = $_POST['bancos'];
$tipobco = $_POST['tipobco'];
$idestatus = $_POST['idestatus'];
$str = "INSERT INTO bancos(banco, tipo, idestatus) VALUES ('".ucfirst($bancos)."','".$tipobco."','".$idestatus."')";
$conexion = $mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
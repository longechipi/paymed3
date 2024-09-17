<?php 
require('../../conf/conexion.php');
$tipocuenta = $_POST['tipocuenta'];
$estatus = $_POST['estatus'];

$str = "INSERT INTO tipocuenta(tipocuenta,idestatus) VALUES ('" .ucfirst( $tipocuenta) . "','" . $estatus . "')";
$conexion = $mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
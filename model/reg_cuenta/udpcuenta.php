<?php 
require('../../conf/conexion.php');
$idtc        = $_POST['idtc'];
$tipocuenta = $_POST['tipocuenta'];
$estatus     = $_POST['estatus'];

$str = "UPDATE tipocuenta SET tipocuenta='" . ucfirst($tipocuenta) . "', idestatus='" . $estatus . "' WHERE idtipocuenta = '" . $idtc . "'";
$conexion = $mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
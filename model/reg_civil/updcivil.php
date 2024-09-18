<?php 
require('../../conf/conexion.php');
$idec = $_POST['idec'];
$estado = $_POST['estado'];
$estatus = $_POST['estatus'];
$str = "UPDATE estadocivil SET estcivil='" . ucfirst($estado) . "', idestatus='" . $estatus . "' WHERE idestcivil = '" . $idec . "'";
$conexion = $mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
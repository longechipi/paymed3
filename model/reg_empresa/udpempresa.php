<?php 
require('../../conf/conexion.php');
$idtp = $_POST['idtp'];
$tipoempresa = $_POST['tipoempresa'];
$estatus = $_POST['estatus'];

$str = "UPDATE tipoempresa SET tipoempresa='" . ucfirst($tipoempresa) . "', idestatus='" . $estatus . "' WHERE idtipoempresa = '" . $idtp . "'";
$conexion = $mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}

?>
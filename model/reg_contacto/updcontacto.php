<?php 
require('../../conf/conexion.php');
$idcontacto = $_POST['idcontacto'];
$tipocontacto = $_POST['tipocontacto'];
$estatus = $_POST['estatus'];

$str = "UPDATE tipocontacto SET tipocontacto='" . ucfirst($tipocontacto) . "', idestatus='" . $estatus . "' WHERE idtipocontacto= '" . $idcontacto . "'";
$conexion = $mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
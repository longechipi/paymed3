<?php 
require('../../conf/conexion.php');
$idsex = $_POST['idsex'];
$sexo = $_POST['sexo'];
$estatus = $_POST['estatus'];
$str = "UPDATE sexo SET sexo='" . ucfirst($sexo) . "', idestatus='" . $estatus . "' WHERE idsexo= '" . $idsex . "'";
$conexion = $mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
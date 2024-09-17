<?php 
require('../../conf/conexion.php');
$sexo = $_POST['sexo'];
$estatus = $_POST['estatus'];
$str = "INSERT INTO sexo(sexo,idestatus) VALUES ('" .ucfirst( $sexo) . "','" . $estatus . "')";
$conexion = $mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}

?>
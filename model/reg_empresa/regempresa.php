<?php 
require('../../conf/conexion.php');
$tipoempresa = $_POST['tipoempresa'];
$estatus = $_POST['estatus'];

$str="INSERT INTO tipoempresa(tipoempresa,idestatus) VALUES ('".ucfirst($tipoempresa)."','".$estatus."')";
$conexion=$mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}

?>
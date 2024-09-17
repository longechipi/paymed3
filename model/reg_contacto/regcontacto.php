<?php
require('../../conf/conexion.php');
$contacto = $_POST['contacto'];
$estatus = $_POST['estatus'];

$str="INSERT INTO tipocontacto(tipocontacto,idestatus, idtipouser) VALUES ('".ucfirst($contacto)."','".$estatus."', '0')";
$conexion=$mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
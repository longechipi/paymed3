<?php 
require('../../conf/conexion.php');
$idfrecuencia= $_POST['idfrecuencia'];
$frecuencia = $_POST['frecuencia'];
$estatus     = $_POST['estatus'];

$str="UPDATE frecuenciapago SET frecuencia='".ucfirst($frecuencia)."', idestatus='".$estatus."' WHERE idfq = '".$idfrecuencia."'";
$conexion=$mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
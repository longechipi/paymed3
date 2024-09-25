<?php
require('../../conf/conexion.php');
$servicios = $_POST['servicios'];
$estatus = $_POST['estatus'];
$cod = mt_rand(0, 999);
$cod1 = str_pad($cod, 3, '0', STR_PAD_LEFT);
$cod_ser = strtoupper(substr($servicios, 0, 3));
$nomenclatura = $cod_ser.'-'.$cod1;
$str="INSERT INTO serviciosafiliados(servicio, nomenclatura, idestatus) VALUES ('".ucfirst($servicios)."','$nomenclatura','".$estatus."')";
$conexion=$mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
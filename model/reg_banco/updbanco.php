<?php 
require('../../conf/conexion.php');
$idbco    = $_POST['idbco'];
$banco     = $_POST['banco'];
$tipo       = $_POST['tipo'];
$estatus    = $_POST['estatus'];
$str = "UPDATE bancos SET banco='".ucfirst($banco)."', tipo='".$tipo."' , idestatus='".$estatus."' 
      WHERE idbco = '".$idbco."'";
$conexion = $mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
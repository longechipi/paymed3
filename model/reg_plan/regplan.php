<?php 
require('../../conf/conexion.php');

$nbplan  = $_POST['nbplan'];
$ctplan  = $_POST['ctplan'];
$ddplan  = $_POST['ddplan'];
$pcplan  = $_POST['pcplan'];
$estatus = $_POST['estatus'];
$str = "INSERT INTO planes (plan,costo,dias,transaccion,idestatus) VALUES ('".strtoupper($nbplan)."','".$ctplan."','".$ddplan."','".$pcplan."','".$estatus."')";
$conexion = $mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}

?>
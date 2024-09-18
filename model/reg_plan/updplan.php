<?php 
require('../../conf/conexion.php');
$idtp    = $_POST['idtp'];
$nbplan  = $_POST['nbplan'];
$ctplan  = $_POST['ctplan'];
$ddplan  = $_POST['ddplan'];
$pcplan  = $_POST['pcplan'];
$estatus = $_POST['estatus'];
$str = "UPDATE planes SET plan='".strtoupper($nbplan)."', costo='".$ctplan."', dias='".$ddplan."', transaccion='".$pcplan."', idestatus='".$estatus."' 
           WHERE idplan = '" . $idtp . "'";
$conexion = $mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
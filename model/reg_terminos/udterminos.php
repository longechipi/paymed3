<?php 
require('../../conf/conexion.php');
$termn = $_POST['termn'];
$str = "UPDATE termcondi SET terminos='" . strtoupper($termn) . "' WHERE 1";
$conexion = $mysqli->query($str);
if($conexion){
    echo "1";
}else{
	echo "0";
}
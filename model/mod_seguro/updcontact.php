<?php 
require('../../conf/conexion.php');
$nocli     =$_POST['nocli'];
$contacto1 =$_POST['contacto1'];
$telefono  =$_POST['telefono'];
$correo1   =$_POST['correo1'];
$cargo1    =$_POST['cargo1'];
$dpto1     =$_POST['dpto1'];

$str="INSERT INTO asegura_contacto (idaseg, idtipocontac, nombres, cargo, telefono, correo, dpto) 
VALUES ('".$nocli."','0', '".strtoupper($contacto1)."','".$cargo1."','".strtoupper($telefono)."','".strtoupper($correo1)."','".strtoupper($dpto1)."')";
$conexion=$mysqli->query($str);

if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
<?php 
require('../../conf/conexion.php');
$nocli    =$_POST['nocli'];
$servi    =$_POST['servi'];
$canti    =$_POST['canti'];
$monto    =$_POST['monto'];
$periodo  =$_POST['periodo'];

$str="INSERT INTO asegurador_servicios (idaseg, idserv, cantidad, monto, periodo) 
VALUES ('".$nocli."','".$servi."','".$canti."','".$monto."','".strtoupper($periodo)."')";
$conexion=$mysqli->query($str);

if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
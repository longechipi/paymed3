<?php 
require('../../conf/conexion.php');

$id_cita = $_POST['id_cita'];
$estatus = $_POST['estatus'];

$a = "UPDATE citas SET idestatus = $estatus WHERE idcita = 62 ";
$ares=$mysqli->query($a);
if($ares){
    echo "1";
}else{
    echo "0";
}
?>
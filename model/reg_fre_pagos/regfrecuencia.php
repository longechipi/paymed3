<?php 
require('../../conf/conexion.php');
$fq = $_POST['fq'];
$estatus = $_POST['estatus'];
$str="INSERT INTO frecuenciapago(frecuencia,idestatus) VALUES ('".ucfirst($fq)."','".$estatus."')";
$conexion=$mysqli->query($str);
if($conexion){
    echo "1";
}else{
    echo "0";
}

?>
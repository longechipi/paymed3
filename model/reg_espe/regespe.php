<?php 
require('../../conf/conexion.php');
$especialidadmed = $_POST['especialidadmed'];
$estatus = $_POST['estatus'];
$str = "INSERT INTO especialidadmed(especialidad,idestatus) VALUES ('" .ucfirst( $especialidadmed) . "','" . $estatus . "')";
$conexion = $mysqli->query($str);
if($conexion){
    echo "1";
}else{
    echo "0";
}

?>
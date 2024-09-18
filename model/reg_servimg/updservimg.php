<?php 
require('../../conf/conexion.php');
$idimage = $_POST['idimage'];
$x = $_POST['idimage'];
$servicio = trim($_POST['servicio']);
$zona = trim($_POST['zona']);
$estudio = trim($_POST['estudio']);
$idestatus= $_POST['idestatus'];

$str = "UPDATE servimage SET servicio='".ucfirst($servicio)."',zona='".ucfirst($zona)."',estudio='".ucfirst($estudio)."',idestatus='".$idestatus."' WHERE idimage ='".$idimage."';"; 
$conexion = $mysqli->query($str);
if($conexion){
    echo "1";
}else{
	echo "0";
}
?>
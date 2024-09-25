<?php 
require('../../conf/conexion.php');
$correo =$_POST['correo'];
$idmed =$_POST['idmed'];

$a ="SELECT count(a.correo) as existe
FROM medicosxasist m
INNER JOIN asistentes a ON m.idasist = a.idasist
INNER JOIN medicos med ON med.idmed = m.idmed
WHERE a.correo = '$correo'
AND m.idmed = $idmed";
$result = $mysqli->query($a);
$row = $result->fetch_assoc();
$existe = $row['existe'];
if($existe > 0){
    echo 1;
}else{
    echo 0;
}

?>
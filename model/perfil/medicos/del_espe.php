<?php 
require('../../../conf/conexion.php');
$id = $_POST['id'];
$idmed = $_POST['idmed'];
$a = ("DELETE FROM medicos_esp WHERE idespmed='$id' AND idmed = $idmed ");
$ares=$mysqli->query($a);
echo $id;
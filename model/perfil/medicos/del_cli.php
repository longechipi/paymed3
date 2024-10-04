<?php 
require('../../../conf/conexion.php');
$id = $_POST['id'];
$idmed = $_POST['idmed'];
$a = "DELETE FROM clinicamedico WHERE idclinica = $id AND idmed = $idmed";
$ares=$mysqli->query($a);
$b="DELETE FROM horariomed WHERE idclinica = $id AND idmed = $idmed";
$bres=$mysqli->query($b);
echo $id;
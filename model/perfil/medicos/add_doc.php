<?php 
require('../../../conf/conexion.php');
$idmed = $_POST['idmed'];
$codcolemed = $_POST['codcolemed'];
$mpsscod = $_POST['mpsscod'];

$a ="UPDATE medicos SET codcolemed='$codcolemed', mpss='$mpsscod' WHERE idmed='$idmed'";
//$ares=$mysqli->query($a); 

echo $a;
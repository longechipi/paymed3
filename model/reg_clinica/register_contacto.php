<?php 
require('../../conf/conexion.php');
$nocli     =$_POST['nocli'];
$contacto1 =$_POST['contacto1'];
$coda      =$_POST['coda'];
$telefono  =$coda.''.$_POST['telefono'];
$correo1   =$_POST['correo1'];
$cargo1    =$_POST['cargo1'];
$dpto1     =$_POST['dpto1'];
$str="INSERT INTO clinicas_contacto (idclinica, idtipocontac, contacto, cargo, telefono, correo, dpto) 
VALUES ('".$nocli."','0', '".strtoupper($contacto1)."','".$cargo1."','".strtoupper($telefono)."','".strtoupper($correo1)."','".strtoupper($dpto1)."')";
$conexion=$mysqli->query($str);
echo 1;
?>		
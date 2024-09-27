<?php 
require('../../conf/conexion.php');

$idasis = $_POST['idasis'];
$idlogin1 = $_POST['idlogin'];
//--------DATOS BASICOS PARA EL LOGIN---------//
$apellidos =$_POST['apellidos'];
$nombres =$_POST['nombres'];
$nrodoc =$_POST['nrodoc'];
$correo =$_POST['correo'];
$movil =$_POST['movil'];
$fullname =strtoupper($apellidos).' '.strtoupper($nombres);
$idestatus =$_POST['idestatus'];

//--------ACTUALIZAR DATOS DEL LOGIN---------//
$str="UPDATE loginn SET apellidos ='$apellidos', nombres ='$nombres', fullname ='$fullname', 
cedula='$nrodoc', movil='$movil' WHERE idlogin=$idlogin1";
$conexion=$mysqli->query($str);

//-------ACTUALIZA DATOS ASISTENTE---------//
$str1="UPDATE asistentes SET nrodoc='$nrodoc',apellidos='$apellidos',nombres='$nombres',movil='$movil', 
idestatus='$idestatus' WHERE idlogin= '$idlogin1'";
$conexion1=$mysqli->query($str1);
if($conexion){
	echo "1";
}else{
	echo "0";
}



?>
<?php 
require('../../conf/conexion.php');
$correo =strtolower($_POST['correo']);
$apellidos =strtoupper($_POST['apellidos']);
$nombres =strtoupper($_POST['nombres']);
$full_name = $apellidos." ".$nombres;
$cedula =$_POST['cedula'];
$nombrecargo =$_POST['nombrecargo'];
$tpasist =$_POST['tpasist'];
$movil =$_POST['movil'];
$idestatus ='A';
$idmed =$_POST['idmed'];
$idloginform = $_POST['idlogin'];
$clave = uniqid();
$usuario = $_POST['usuario'];

//-------- Nombre del Doctor ----------//
$a="SELECT CONCAT(apellido1, ' ',apellido2, ' ',nombre1, ' ',nombre2) AS nom_med FROM medicos WHERE idmed= $idmed";
$ares = $mysqli->query($a);
$arow = mysqli_fetch_array($ares);
$nom_med = $arow['nom_med'];

//-------- SE CREA EL USUARIO EN LOGINN ----------//
$str="INSERT INTO loginn (idlogin, nombres, apellidos, fullname, cedula, correo, usuario, telefono, movil, direccion, cargo, nombrecargo, clave, privilegios, idtrabajacon, trabajacon, estatus, imagen) 
VALUES(NULL, '$nombres', '$apellidos', '$full_name', '$cedula','$correo', '$correo', '$movil', '$movil', 'POR EDITAR', '$tpasist', '$nombrecargo', '$clave', 7, '$idloginform', '$usuario', '$idestatus', '1.jpg')";
$conexion=$mysqli->query($str);

//------- SE BUSCA EL ULTIMO IDLOGIN CREADO --------//
$sqlmaxid = ("SELECT max(idlogin) FROM loginn;");
$resultmaxid=$mysqli->query($sqlmaxid); 
$rowmaxid = mysqli_fetch_array($resultmaxid);
$idlogin = $rowmaxid[0];

//-------- SE CREA EL ASISTENTE ----------//
$str1="INSERT INTO asistentes(idasist, idlogin, nrodoc, apellidos, nombres, movil, correo, cargo, tpasist, idestatus) 
VALUES (null,'$idlogin','$cedula','$apellidos','$nombres','$movil','$correo','$nombrecargo', '$tpasist','1')";
$conexion1=$mysqli->query($str1);


//-------- SE BUSCA EL ULTIMO ASISTENTE CREADO----------//
$sqlmaxida = ("SELECT max(idasist) FROM asistentes;");
$resultmaxida=$mysqli->query($sqlmaxida); 
$rowmaxida = mysqli_fetch_array($resultmaxida);
$idasist = $rowmaxida[0];

//------- SE CREA LA RELACION ENTRE ASISTENTE Y MEDICO ----------//
$str2="INSERT INTO medicosxasist( idasist, idmed, onoff) VALUES('$idasist', '$idmed', 'On')";
$conexion2=$mysqli->query($str2);

if($conexion){
	echo "1";
}else{
	echo "0";
}
include('../../mail/envia_asistente.php');


















?>
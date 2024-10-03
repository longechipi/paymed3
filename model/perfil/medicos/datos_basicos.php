<?php 
require('../../../conf/conexion.php');
//------ Id del Medico -------//
$idmed = $_POST['idmed_basico'];
$idlogin = $_POST['idlogin_basico'];
//------ Datos Personales -------//
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$nombre1 = $_POST['nombre1'];
$nombre2 = $_POST['nombre2'];
$tprif = $_POST['tprif'];
$rif = $_POST['rif'];
$fnacimiento = $_POST['fnacimiento'];
$edad = $_POST['edad'];
$idsexo = $_POST['idsexo'];
$idestcivil = $_POST['idestcivil'];
$movil = $_POST['movil'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$correoalt = $_POST['correoalt'];
$idpais = $_POST['idpais'];
$idestado = $_POST['idestado'];
$idmunicipio = $_POST['idmunicipio'];
$idparroquia = $_POST['idparroquia'];
$urbanizacion = $_POST['urbanizacion'];
$calleav = $_POST['calleav'];
$casaedif = $_POST['casaedif'];
$piso = $_POST['piso'];
$oficina = $_POST['oficina'];
$codpostal = $_POST['codpostal'];

$a="UPDATE medicos SET idcomp = 0, rif='$rif', nombre1='$nombre1', nombre2='$nombre2', apellido1='$apellido1', apellido2='$apellido2', fnacimiento='$fnacimiento', edad='$edad', idsexo='$idsexo', idestcivil='$idestcivil', operadora= 0000, movil='$movil',codarea=0000,telefono='$telefono',correoalt='$correoalt', idpais='$idpais',idestado='$idestado',idmunicipio='$idmunicipio',idparroquia='$idparroquia',correoppal='$correo',calleav='$calleav',casaedif='$casaedif',piso='$piso',oficina='$oficina',urbanizacion='$urbanizacion',codpostal='$codpostal',dirnovzla='----',codpostalnovzla=0000 WHERE idmed = $idmed";
$conexion=$mysqli->query($a);
if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
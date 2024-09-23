<?php 
require('../../conf/conexion.php');
$fecharegistro = date("d-m-Y");
$rif =$_POST['tprif'].$_POST['rif'];
$razsocial =$_POST['razsocial'];
$idtiposeg =$_POST['idtiposeg'];

$idpais =$_POST['idpais'];
$idestado =$_POST['idestado'];
$idmunicipio =$_POST['idmunicipio'];
$idparroquia =$_POST['idparroquia'];

$urbanizacion =$_POST['urbanizacion'];
$calleav =$_POST['calleav'];
$casaedif =$_POST['casaedif'];
$piso =$_POST['piso'];
$oficina =$_POST['oficina'];
$codpostal =$_POST['codpostal'];

$str="INSERT INTO aseguradores (idlogin, idtiposeg, rif, razsocial, movil, ttelf, telefono, correo, idpais, idestado, idmunicipio, idparroquia, calleav, casaedif, piso, oficina, urbanizacion, codpostal, idestatus, fecharegistro) 
	VALUES ('0','".$idtiposeg."','".strtoupper($rif)."', '".strtoupper($razsocial)."', '0' ,'0','0','email@email.com','".$idpais."','".$idestado."','".$idmunicipio."','".$idparroquia."','".strtoupper($calleav)."','".strtoupper($casaedif)."','".strtoupper($piso)."','".strtoupper($oficina)."','".strtoupper($urbanizacion)."','".$codpostal."','1','".$fecharegistro."')";
$conexion=$mysqli->query($str);

if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
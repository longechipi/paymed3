<?php 
require('../../conf/conexion.php');

$idaseg=$_POST['idaseg'];
$rif =$_POST['tprif'].$_POST['rif'];
$razsocial =$_POST['razsocial'];
$idpais      =$_POST['idpais'];
$idestado    =$_POST['idestado'];
$idmunicipio =$_POST['idmunicipio'];
$idparroquia =$_POST['idparroquia'];
$urbanizacion =$_POST['urbanizacion'];
$calleav      =$_POST['calleav'];
$casaedif     =$_POST['casaedif'];
$piso =$_POST['piso'];
$oficina      =$_POST['oficina'];
$codpostal    =$_POST['codpostal'];
$idestatus    =$_POST['idestatus'];
$str="UPDATE aseguradores SET rif='".strtoupper($rif)."',razsocial='".strtoupper($razsocial)."', idpais='".$idpais."',idestado='".$idestado."',idmunicipio='".$idmunicipio."',idparroquia='".$idparroquia."',
calleav='".strtoupper($calleav)."',casaedif='".strtoupper($casaedif)."',piso='".strtoupper($piso)."',oficina='".strtoupper($oficina)."',urbanizacion='".strtoupper($urbanizacion)."',codpostal='".$codpostal."',idestatus='".$idestatus."'
WHERE idaseg='".$idaseg."'";
$conexion=$mysqli->query($str);
if($conexion){
	echo "1";
}else{
	echo "0";
}
?>
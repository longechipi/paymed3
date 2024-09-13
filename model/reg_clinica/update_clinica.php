<?php 
require('../../conf/conexion.php');

$idclinica   = $_POST['idclinica'];
$rif         = $_POST['tprif'] . $_POST['rif'];
$razsocial   = $_POST['razsocial'];
$nbcm        = $_POST['nbcm'];
$correoppal  = $_POST['correoppal'];
$tipo        = $_POST['tipo'];
$tipoprov    = $_POST['idtipoprov'];
$descripcion = $_POST['descripcion'];

$idpais      = $_POST['idpais'];
$idestado    = $_POST['idestado'];
$idmunicipio = $_POST['idmunicipio'];
$idparroquia = $_POST['idparroquia'];

$urbanizacion = $_POST['urbanizacion'];
$calleav      = $_POST['calleav'];
$casaedif     = $_POST['casaedif'];
$piso         = $_POST['piso'];
$oficina      = $_POST['oficina'];
$codpostal    = $_POST['codpostal'];
$idestatus    = $_POST['idestatus'];

$str = "UPDATE clinicas SET rif='" . strtoupper($rif) . "',razsocial='" . strtoupper($razsocial) . "', nombrecentrosalud='" . strtoupper($nbcm) . "',descrip='" . strtoupper($descripcion) . "',idtipo='" . $tipo . "',idtppr='" . $tipoprov . "',idpais='" . $idpais . "',idestado='" . $idestado . "',idmunicipio='" . $idmunicipio . "',idparroquia='" . $idparroquia . "',correoppal='" . strtoupper($correoppal) . "',calleav='" . strtoupper($calleav) . "',casaedif='" . strtoupper($casaedif) . "',piso='" . strtoupper($piso) . "',oficina='" . strtoupper($oficina) . "',urbanizacion='" . strtoupper($urbanizacion) . "',codpostal='" . $codpostal . "', idestatus='" . $idestatus . "' WHERE idclinica='" . $idclinica . "';";
$conexion = $mysqli->query($str);
echo 1;
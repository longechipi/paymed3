<?php 
require('../../conf/conexion.php');
$alta        = date('d/m/Y');
$rif         =$_POST['tprif'].$_POST['rif'];
$razsocial   =$_POST['razsocial'];
$nbcs        =$_POST['nbcs'];
$correoppal  =$_POST['correoppal'];
$idtipo      =$_POST['idtipo'];
$idtipoprov  =$_POST['idtipoprov'];
$descripcion =$_POST['descripcion'];

$idpais      =$_POST['idpais'];
$idestado    =$_POST['idestado'];
$idmunicipio =$_POST['idmunicipio'];
$idparroquia =$_POST['idparroquia'];

$urbanizacion =$_POST['urbanizacion'];
$calleav      =$_POST['calleav'];
$casaedif     =$_POST['casaedif'];
$piso         =$_POST['piso'];
$oficina      =$_POST['oficina'];
$codpostal    =$_POST['codpostal'];


// $str="INSERT INTO loginn (idlogin, nombres, apellidos, fullname, correo, usuario, cargo, cedula, clave, privilegios) 
// VALUES (NULL, '".$razsocial."', '".$razsocial."', '".$razsocial."', '".$correoppal."', '".$correoppal."', 'Clinica', '".$rif."','".$rif."','5' );";
// $conexion=$mysqli->query($str);

$sqllast = ("SELECT max(idlogin) from loginn;");
$objlast=$mysqli->query($sqllast); $arrlast=$objlast->fetch_array();
$idlogin=$arrlast[0];
    

$str="INSERT INTO clinicas (idlogin, rif, razsocial, nombrecentrosalud, descrip, idtipo, idtppr, idpais, idestado, idmunicipio, idparroquia, correoppal, calleav, casaedif, piso, oficina, urbanizacion, codpostal, idestatus, fecharegistro) 
VALUES ('".$idlogin."','".strtoupper($rif)."','".strtoupper($razsocial)."','".strtoupper($nbcs)."','".$descripcion."', '".$idtipo."','".$idtipoprov."','".$idpais."','".$idestado."','".$idmunicipio."','".$idparroquia."','".strtoupper($correoppal)."','".strtoupper($calleav)."','".strtoupper($casaedif)."','".strtoupper($piso)."','".strtoupper($oficina)."','".strtoupper($urbanizacion)."','".$codpostal."','1','".$alta."')";
$conexion=$mysqli->query($str);

echo 1;
    
?>
<?php
require('../../conf/conexion.php');

$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$nombre1   = $_POST['nombre1'];
$nombre2   = $_POST['nombre2'];

$tpdoc  = $_POST['tpdoc'];
$nrodoc = $tpdoc.''.$_POST['nrodoc'];
/*Valido de nuevo cedula*/
$sql = ("SELECT idpaci FROM pacientes WHERE cedula = '".$nrodoc."';");
$result=$mysqli->query($sql);
$row_cnt = $result->num_rows;
$esta='0';
if($row_cnt>0){$esta='1';
      echo '<script language="javascript">alert("ERROR:Nro. Cedula Registrado!");
      window.history.back();</script>';
      
      //window.location.href="rpt_pacxmed.php"
      //header('Location: rpt_pacxmed.php');
      //exit();
}
$fnacimiento = $_POST['fnacimiento'];
$edad        = $_POST['edad'];
$idsexo      = $_POST['idsexo'];


$operadora = ''; // Queda en un solo campo  $_POST['operadora'];
$movil     = $_POST['movil'];
$correo    = $_POST['correo'];

$idpais = $_POST['idpais'];
$idestado = $_POST['idestado'];
$idmunicipio = $_POST['idmunicipio'];
$idparroquia = $_POST['idparroquia'];

$urbanizacion = ''; //$_POST['urbanizacion'];
$calleav = $_POST['calleav'];
$casaedif =  ''; //$_POST['casaedif'];
$piso =  ''; //$_POST['piso'];
$codpostal = $_POST['codpostal'];


$str = "INSERT INTO pacientes (idlogin, idmed, idregistrador, apellido1, apellido2, nombre1, nombre2, cedula, fnacimiento, edad, idsexo, correo, operadora, movil, idpais, idestado, idmunicipio, idparroquia, calleav, casaedif, piso, urbanizacion, codpostal, estatus) 
      VALUES ('".$idlogin."','".$idmed."','".$idregistrador."','".strtoupper($apellido1)."','".strtoupper($apellido2)."','".strtoupper($nombre1)."','".strtoupper($nombre2)."','".$nrodoc."','".$fnacimiento."','".$edad."','".$idsexo."','".$correo."','".$operadora."','".$movil."','".$idpais."','".$idestado."','".$idmunicipio."','".$idparroquia."','".$calleav."','".$casaedif."','".$piso."','".$urbanizacion."','".$codpostal."','1')";
   $conexion = $mysqli->query($str);
   
   echo $str;



?>
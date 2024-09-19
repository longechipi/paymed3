<?php 
require('../../conf/conexion.php');

$apellido1 = strtoupper($_POST['apellido1']);
   $apellido2 = strtoupper($_POST['apellido2']);
   $nombre1 = strtoupper($_POST['nombre1']);
   $nombre2 = strtoupper($_POST['nombre2']);

   $rif = $_POST['tprif'] . $_POST['rif'];
   $nrodoc = $_POST['tpdoc'] . $_POST['nrodoc'];

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

   $urbanizacion = strtoupper($_POST['urbanizacion']);
   $calleav = strtoupper($_POST['calleav']);
   $casaedif = $_POST['casaedif'];
   $piso = $_POST['piso'];
   $oficina = $_POST['oficina'];
   $codpostal = $_POST['codpostal'];

   $str = "INSERT INTO loginn (idlogin, correo, cargo, clave, privilegios, estatus) 
   VALUES (NULL, '" . $correo . "', 'Medico', '123','2', 'A' );";
   //$conexion = $mysqli->query($str);
echo $str;

// if($conexion){
// 	echo "1";
// }else{
// 	echo "0";
// }
?>
<?php
require('../../conf/conexion.php');

//------------ Datos que registra ------------//
$idlogin = $_POST['idlogin'];
$privilegios = $_POST['privi'];
$idmed = empty($_POST['idmedico']) ? '' : $_POST['idmedico'];
$medi_tra = empty($_POST['medi_tra']) ? '' : $_POST['medi_tra'];

//------------ Datos de Paciente -------------//
$apellido1 = strtoupper($_POST['apellido1']);
$apellido2 = strtoupper($_POST['apellido2']);
$nombre1   = strtoupper($_POST['nombre1']);
$nombre2   = strtoupper($_POST['nombre2']);
$nrodoc = $_POST['tpdoc'].''.$_POST['nrodoc'];
$fnacimiento = $_POST['fnacimiento'];
$edad        = $_POST['edad'];
$idsexo      = $_POST['idsexo'];
$idestcivil  = $_POST['idestcivil'];
$movil     = $_POST['movil'];
$correo    = $_POST['correo'];
$idpais = $_POST['idpais'];
$idestado = $_POST['idestado'];
$idmunicipio = $_POST['idmunicipio'];
$idparroquia = $_POST['idparroquia'];
$calleav = strtoupper($_POST['calleav']);

if($privilegios== 7){
            //---------- PERFIL ASISTENTE ------------- //
//--------- SE BUSCA EL ID DEL MEDICO SI ES ASISTENTE ----------//
      $a1 = "SELECT L.idlogin, L.idtrabajacon, M.idmed
            FROM loginn L 
            INNER JOIN medicos M ON L.idtrabajacon = M.idlogin 
            WHERE L.idlogin = $idlogin";
      $ares=$mysqli->query($a1);
      $rowa1 = $ares->fetch_array();
      $idtrabajacon = $rowa1['idmed'];
      $idasistente = $rowa1['idlogin'];

$a="INSERT INTO pacientes(idlogin, idaseg, idmed, idregistrador, apellido1, apellido2, nombre1, nombre2, cedula, fnacimiento, edad, idsexo, idestcivil, correo, codarea, telefono, operadora, movil, idpais, idestado, idmunicipio, idparroquia, calleav, casaedif, piso, urbanizacion, codpostal, dirnovzla, codpostalnovzla, estatus) 
VALUES (0,0,'$idtrabajacon','$idasistente','$apellido1','$apellido2','$nombre1','$nombre2','$nrodoc','$fnacimiento','$edad','$idsexo','$idestcivil','$correo','0000','$movil','0000','$movil','$idpais','$idestado','$idmunicipio','$idparroquia','--','--','0','$calleav','0000','---','0000',1)";
$conexion=$mysqli->query($a);
      if($conexion){
            echo "1";
      }else{
            echo "0";
      }
}elseif($privilegios== 2){
        //---------- PERFIL MEDICO ------------- //
//--------- SE BUSCA ID DEL MEDICO SI ES MEDICO ---------//   
$a="INSERT INTO pacientes(idlogin, idaseg, idmed, idregistrador, apellido1, apellido2, nombre1, nombre2, cedula, fnacimiento, edad, idsexo, idestcivil, correo, codarea, telefono, operadora, movil, idpais, idestado, idmunicipio, idparroquia, calleav, casaedif, piso, urbanizacion, codpostal, dirnovzla, codpostalnovzla, estatus) 
VALUES (0,0,'$idmed','$idlogin','$apellido1','$apellido2','$nombre1','$nombre2','$nrodoc','$fnacimiento','$edad','$idsexo','$idestcivil','$correo','0000','$movil','0000','$movil','$idpais','$idestado','$idmunicipio','$idparroquia','--','--','0','$calleav','0000','---','0000',1)";

$conexion=$mysqli->query($a);
      if($conexion){
            echo "1";
      }else{
            echo "0";
      }   
}else{
        //---------- PERFIL ADMINISTRADOR ------------- //
//---------- SE INSERTA EL MEDICO SELECCIONADO SI ES ADMIN ---------//
$a="INSERT INTO pacientes(idlogin, idaseg, idmed, idregistrador, apellido1, apellido2, nombre1, nombre2, cedula, fnacimiento, edad, idsexo, idestcivil, correo, codarea, telefono, operadora, movil, idpais, idestado, idmunicipio, idparroquia, calleav, casaedif, piso, urbanizacion, codpostal, dirnovzla, codpostalnovzla, estatus) 
VALUES (0,0,'$medi_tra','$idlogin','$apellido1','$apellido2','$nombre1','$nombre2','$nrodoc','$fnacimiento','$edad','$idsexo','$idestcivil','$correo','0000','$movil','0000','$movil','$idpais','$idestado','$idmunicipio','$idparroquia','--','--','0','$calleav','0000','---','0000',1)";  
$conexion=$mysqli->query($a);
      if($conexion){
            echo "1";
      }else{
            echo "0";
      }     
}


?>
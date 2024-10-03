<?php
require('../../conf/conexion.php');
//---- ID de Paciente ----//
$idpaci = $_POST['idpaci'];
//---- Datos Personales ----//
$apellido1 = strtoupper($_POST['apellido1']);
$apellido2 = strtoupper($_POST['apellido2']);
$nombre1 = strtoupper($_POST['nombre1']);
$nombre2 = strtoupper($_POST['nombre2']);
$fec_nac = $_POST['fnacimiento'];
$edad = $_POST['edad'];
$tpdoc = $_POST['tpdoc'];
$nrodoc = $_POST['nrodoc'];
$cedula = $tpdoc.''.$nrodoc;
$idsexo = $_POST['idsexo'];
$movil = $_POST['movil'];
$correo = $_POST['correo'];
$idpais = $_POST['idpais'];
$idestado = $_POST['idestado'];
$idmunicipio = $_POST['idmunicipio'];
$idparroquia = $_POST['idparroquia'];
$calleav = strtoupper($_POST['calleav']);

//--------QUEDA PENDIENTE PARA OTRA FASE EL CAMBIO DE PACIENTE A OTRO DR ----------//
$a="UPDATE pacientes SET apellido1='$apellido1', apellido2='$apellido2', 
nombre1='$nombre1', nombre2='$nombre2', fnacimiento='$fec_nac', edad='$edad', cedula='$cedula', 
idsexo='$idsexo', correo='$correo', codarea='0000', telefono='$movil', operadora = '0000',
idpais='$idpais', idestado='$idestado', idmunicipio='$idmunicipio', idparroquia='$idparroquia', 
calleav='$calleav', casaedif = '--', piso = '--', urbanizacion = '--', codpostal = '0000', dirnovzla='--', codpostalnovzla = '0000'
WHERE idpaci='$idpaci'";
$conexion=$mysqli->query($a);
if($conexion){
    echo 1;
}else{
    echo 0;
}
?>


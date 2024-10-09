<?php
require('../../../conf/conexion.php');
$idlogin = $_POST['idlogin'];
$clave = $_POST['clave'];
$correo = $_POST['correo'];
$apellidos = $_POST['apellidos'];
$nombres = $_POST['nombres'];
$cedula = $_POST['cedula'];
$telf = $_POST['telf'];
$nom_completo = $apellidos." ".$nombres;
$a ="SELECT idlogin, correo, clave FROM loginn WHERE idlogin = $idlogin AND correo = '$correo'";
$ares=$mysqli->query($a);
$rowcounti=mysqli_num_rows($ares);
if ($rowcounti>0) {
    $b ="UPDATE loginn SET clave ='$clave', fullname = '$nom_completo', apellidos = '$apellidos', nombres = '$nombres', cedula = '$cedula', telefono = '$telf' WHERE idlogin = $idlogin AND correo = '$correo'";
    $bres=$mysqli->query($b);
    if ($bres) {
        echo "1";
    }else{
        echo "0";
    }
}else{
    echo "0";
}
?>

<?php
require('../../conf/conexion.php');
$correo = $_POST['correo'];
$a="SELECT correo FROM loginn WHERE correo = '$correo'";
$ares=$mysqli->query($a);
    if ($ares->num_rows > 0) {
        //------ ERROR ------// 
        echo "2";
    }else{
        //------ CORRECTO ------//
        $codigo = mt_rand(100000, 999999);
        $b="INSERT INTO validaciones_email (correo, codigo, idestatus) VALUES('$correo', '$codigo', '3')";
        $bres=$mysqli->query($b);
        if ($bres) {
            include('../../mail/pre-medico.php');
            echo "1";
        }else{
            echo "0";
        }
    }
?>
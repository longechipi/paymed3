<?php 
require('../../../conf/conexion.php');
//------ Id del Medico -------//
$idlogin = $_POST['idmed_banco'];

//------ Datos Nacionales -------//
$idbco = $_POST['idbco'];
$idtipocuenta = $_POST['idtipocuenta'];
$nrocuenta = $_POST['nrocuenta'];
$bank_inter = $_POST['bank_inter']; //Verifica si tiene cuenta Inter

if($bank_inter == 1){
//------ Datos Internacionales -------//
$idpais = $_POST['idpais'];
$idbcoint = $_POST['idbcoint'];
$nrocuentaint = $_POST['nrocuentaint'];
$ach = $_POST['ach'];
$swit = $_POST['swit'];
$aba = $_POST['aba'];
$dircta = strtoupper($_POST['dircta']);
$telf_inter = $_POST['telf_inter'];
$codpostalint = $_POST['codpostalint'];
    //---------- UPDATE PARA CUENTA INTERNACIONAL y NACIONAL ---------//
                        //------ CUENTA NACIONAL ------//
    $a="UPDATE datbconac SET idbco='$idbco', idtipocuenta='$idtipocuenta', nrocuenta='$nrocuenta'
    WHERE idlogin=$idlogin";
    $conexion1=$mysqli->query($a);
                    //------ CUENTA INTERNACIONAL ------//
    $b="UPDATE datbcoint SET idpais='$idpais', idbco='$idbcoint', nrocuenta='$nrocuentaint', ach = '$ach', 
    swit = '$swit', aba ='$aba', dircta = '$dircta', telefono = '$telf_inter', codpostal = '$codpostalint'
    WHERE idlogin= $idlogin";
    $conexion=$mysqli->query($b);
    if($conexion){
        echo "1";
    }else{
        echo "2";
    }
}else{
     //------ CUENTA NACIONAL ------//
    $c="UPDATE datbconac SET idbco='$idbco', idtipocuenta='$idtipocuenta', nrocuenta='$nrocuenta'
    WHERE idlogin=$idlogin";
     $conexion=$mysqli->query($c);
     if($conexion){
         echo "1";
     }else{
         echo "2";
     }
}
















?>
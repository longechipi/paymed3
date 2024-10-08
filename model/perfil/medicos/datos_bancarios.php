<?php 
require('../../../conf/conexion.php');
//------ Id del Medico -------//
$idlogin = $_POST['idmed_banco'];
$nom_comple = strtoupper($_POST['titular']);
$nrodoc = $_POST['nrodoc'];
@$idlogin_med = $_POST['idlogin_med'];
$idlogin = empty($_POST['idlogin_med']) ? $_POST['idmed_banco'] : $idlogin_med;


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
 //---------- SE PREGUNTA SI TIENE CUENTA ------------//
 $a = "SELECT * FROM datbcoint WHERE idlogin =$idlogin";
    $ares=$mysqli->query($a);
    $row_cnt = $ares->num_rows;
     //---------- UPDATE PARA CUENTA INTERNACIONAL y NACIONAL ---------//
    if($row_cnt > 0){
        //------ CUENTA NACIONAL UPDATE ------//
        $e="UPDATE datbconac SET idbco='$idbco', idtipocuenta='$idtipocuenta', nrocuenta='$nrocuenta'
        WHERE idlogin=$idlogin";
        $eres=$mysqli->query($e);
        //------ CUENTA INTERNACIONAL UPDATE ------//
        $d="UPDATE datbcoint SET idpais='$idpais', idbco='$idbcoint', nrocuenta='$nrocuentaint', ach = '$ach', 
        swit = '$swit', aba ='$aba', dircta = '$dircta', telefono = '$telf_inter', codpostal = '$codpostalint'
        WHERE idlogin= $idlogin";
        $dres=$mysqli->query($d);
        if($dres){
            echo "1";
        }else{
            echo "2";
        }
    }else{
         //------ CUENTA INTERNACIONAL INSERT------//
        $b="INSERT INTO datbcoint(idlogin, titular, idpais, nrodoc, idbco, ach, nrocuenta, swit, aba, dircta, telefono, codpostal, idestatus)
        VALUES($idlogin, '$nom_comple', '$idpais', '$nrodoc', '$idbcoint', '$ach', '$nrocuentaint', '$swit', '$aba', '$dircta', '$telf_inter', '$codpostalint', 1)";
         $bres=$mysqli->query($b);
         if($bres){
            echo 1;
         }else{
            echo 0;
         }
    }

}else{
        //------ CUENTA NACIONAL ------//
    //---------- SE PREGUNTA SI TIENE CUENTA ------------//
    $a = "SELECT * FROM datbconac WHERE idlogin =$idlogin";
    $ares=$mysqli->query($a);
    $row_cnt = $ares->num_rows;
        if($row_cnt > 0){
            //------ CUENTA NACIONAL UPDATE ------//
            $c="UPDATE datbconac SET idbco='$idbco', idtipocuenta='$idtipocuenta', nrocuenta='$nrocuenta'
            WHERE idlogin=$idlogin";
             $conexion=$mysqli->query($c);
             if($conexion){
                 echo "1";
             }else{
                 echo "2";
             }
        }else{
            //------ CUENTA NACIONAL INSERT------//
            $b ="INSERT INTO datbconac(idlogin, titular, nrodoc, idbco, idtipocuenta, nrocuenta, idestatus)
            VALUES($idlogin, '$nom_comple', '$nrodoc', '$idbco', '$idtipocuenta','$nrocuenta', 1)";
            $bres=$mysqli->query($b);
            if($bres){
                echo 1;
            }else{
                echo 0;
            }
        }	
}


?>
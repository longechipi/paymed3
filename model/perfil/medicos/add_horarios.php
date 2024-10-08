<?php 
require('../../../conf/conexion.php');
$idmed = $_POST['idmed_hora'];
$idclinica = $_POST['idclinica'];
$consultorio = $_POST['consultorio'];
$piso = $_POST['piso'];
$telefono1 = $_POST['telefono1'];
$telefono2 = $_POST['telefono2'];
$pacxdia = $_POST['pacxdia'];
$pacconseg = $_POST['pacconseg'];
$pacsinseg = $_POST['pacsinseg'];


$a="SELECT idclinica FROM clinicamedico b WHERE b.idmed= $idmed AND idclinica = $idclinica";
$ares=$mysqli->query($a); 
$rowcounti=mysqli_num_rows($ares);
if ($rowcounti>0) {
    //------ Lanza Error si ya la tiene Incluida -----//
    echo '2';
}else{
    //--------- INSERTO PRIMERO EN CLINICAS DONDE TRABAJA ---------//
$b="INSERT INTO clinicamedico(idclinica, idmed, pacxdia, pacconseg, pacsinseg, consultorio, piso, telefono1, telefono2, idestatus)
VALUES ($idclinica, $idmed,$pacxdia, $pacconseg, $pacsinseg, $consultorio, $piso, $telefono1, $telefono2, 1); ";
$bres=$mysqli->query($b); 

//--------- INSERTO HORARIOS ---------//
$horariosJSON = $_POST['horarios'];
$horarios = json_decode($horariosJSON, true);   
    foreach ($horarios as $horario) {
        $dias = $horario['dias'];
        $desde = $horario['desde'];
        $hasta = $horario['hasta'];
    
        $c="INSERT INTO horariomed(idmedcli, idclinica, idmed, dia, desde, hasta, idestatus)
        VALUES (0, $idclinica, $idmed, '$dias','$desde','$hasta', 1); ";
        $cres=$mysqli->query($c); 
    }
    if ($cres) {
        echo '1';
    }else{
        echo '0';
    }
}
?>
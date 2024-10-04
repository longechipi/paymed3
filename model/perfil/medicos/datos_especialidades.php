<?php 
require('../../../conf/conexion.php');
//------- ID MEDICO Y ESPECIALIDAD -------//
$idespmed = $_POST['idespmed'];
$idmed = $_POST['idmed'];

$a="SELECT ME.idespxmed, ME.idmed, ME.idespmed, especialidad
FROM medicos_esp ME
INNER JOIN especialidadmed E ON ME.idespmed = E.idespmed 
WHERE ME.idmed='$idmed' AND ME.idespmed='$idespmed'";
$ares=$mysqli->query($a); 
$rowcounti=mysqli_num_rows($ares);
if ($rowcounti>0) {
    //------ Lanza Error si ya la tiene Incluida -----//
    echo '2';
}else{
    //------- Graba la Informacion -----//
    $b = "INSERT INTO medicos_esp(idmed, idespmed, idestatus) VALUES ('$idmed','$idespmed','1')";
    $bres=$mysqli->query($b);
    $c = "SELECT ME.idespmed, especialidad FROM medicos_esp ME
        INNER JOIN especialidadmed E ON ME.idespmed = E.idespmed 
        WHERE ME.idespxmed = LAST_INSERT_ID();";
    $cres=$mysqli->query($c);
    $rowc=mysqli_fetch_array($cres);
    echo $rowc['idespmed'] .'-' .$rowc['especialidad'];
}
?>
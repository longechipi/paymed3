<?php 
require('../../conf/conexion.php');

$cod_med = $_POST['cod_med'];
$cedula = $_POST['cedula'];

$nom = explode(" ", $_POST['nom_paci']);
$apellido = $nom[0];
$nombre = $nom[1];
$telf = $_POST['telf'];
$correo = $_POST['correo'];
$id_med = $_POST['id_med'];
$id_paci = $_POST['id_paci'];
@$dr_atiende = $_POST['dr_atiende']; //PENDIENTE QUE ES ADMIN
$dia_cita = $_POST['dia_cita'];
$clinica = $_POST['clinica'];

$hora = date_create_from_format("h:i:a", $_POST['hora_cita']);
$hora_cita = date_format($hora, "H:i");

$pac_seg = $_POST['pac_seg'];
$seguro = isset($_POST['seguro']) && !empty($_POST['seguro']) ? $_POST['seguro'] : 0;
$tip_serv = isset($_POST['tip_serv']) && !empty($_POST['tip_serv']) ? $_POST['tip_serv'] : 0;
$motivo = strtoupper(trim($_POST['motivo']));



//------- Validaciones --------//
$b ="SELECT idpaci, fechacita, horacita, idclinica, idmed
FROM citas
WHERE idpaci = $id_paci
AND fechacita = '$dia_cita'
AND idmed = $id_med";
$busqueda=$mysqli->query($b);
if ($busqueda->num_rows>0) {
    echo 2;
    exit();
}

$a="INSERT INTO citas(idpaci, historia, fechacita, horacita, fechasoli, nombre, apellido, telefono, correo, importancia, 
motivo, diagnostico, informes, idaseg, idclinica, idmed, idregistrador, idservaf, nroservi, idestatus)VALUES
($id_paci, 'S/A', '$dia_cita', '$hora_cita', '$dia_cita', '$nombre', '$apellido', '$telf', '$correo', 'R',
'$motivo', '', '', $seguro, $clinica, $cod_med, 0, $tip_serv, 1, 3)";

$ares=$mysqli->query($a);
if ($ares) {
    echo 1;
}else{
    echo 3;
}
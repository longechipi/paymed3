<?php 
require('../../conf/conexion.php');

$cod_med = $_POST['cod_med'];
$cedula = $_POST['cedula'];
$nom_paci = $_POST['nom_paci'];
$telf = $_POST['telf'];
$correo = $_POST['correo'];
$id_med = $_POST['id_med'];
$id_paci = $_POST['id_paci'];
@$dr_atiende = $_POST['dr_atiende']; //PENDIENTE QUE ES ADMIN
$dia_cita = $_POST['dia_cita'];
$clinica = $_POST['clinica'];
$hora_cita = $_POST['hora_cita'];
$pac_seg = $_POST['pac_seg'];
$seguro = $_POST['seguro'];
$tip_serv = $_POST['tip_serv'];
$motivo = $_POST['motivo'];

// INSERT INTO citas(idpaci, historia, fechacita, horacita, fechasoli, nombre, apellido, telefono, correo, importancia, 
// motivo, diagnostico, informes, idaseg, idclinica, idmed, idregistrador, idservaf, nroservi, idestatus)VALUES
// (2, 'S/A', '2024-10-28', '10:00', '2024-10-28', 'LUIS', 'NAVEDA', '04242035515', 'LOISJOSEFINANAVEDA@GMAIL.COM', 'R',
// 'PRUEBA DE INSERT', '', '', 2, 8, 2, 0, 2, 1, 3)
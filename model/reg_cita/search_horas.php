<?php 
require('../../conf/conexion.php');

$clinica = $_POST['clinica'];
$id_med = $_POST['id_med'];
$id_paci = $_POST['id_paci'];

$dia_cita = $_POST['dia_cita'];

$fecha_cita = new DateTime($dia_cita);
$dia_semana_ingles = $fecha_cita->format('l');
$dias_semana_espanol = ['Sunday' => 'Domingo', 'Monday' => 'Lunes', 'Tuesday' => 'Martes', 'Wednesday' => 'Miercoles', 'Thursday' => 'Jueves', 'Friday' => 'Viernes', 'Saturday' => 'Sabado'];

$dia_semana = $dias_semana_espanol[$dia_semana_ingles];

$a = "SELECT HM.desde, HM.hasta
FROM medicos M
LEFT JOIN horariomed HM ON M.idmed = HM.idmed
LEFT JOIN clinicas C ON HM.idclinica = C.idclinica
INNER JOIN clinicamedico CM ON (HM.idmed = CM.idmed AND CM.idclinica = HM.idclinica)
WHERE M.idmed = $id_med
AND HM.dia = '$dia_semana'
AND HM.idclinica = $clinica";

$ares=$mysqli->query($a);

while ($row = $ares->fetch_assoc()) {
    $desde = $row['desde'];
    $hasta = $row['hasta'];

    $inicio = new DateTime($desde);
    $fin = new DateTime($hasta);
    $intervalo = new DateInterval('PT30M'); // Intervalo de 30 minutos

    $horas = array();
    while ($inicio < $fin) {
        $horas[] = $inicio->format('h:i:a');
        $inicio->add($intervalo);
    }
    $datos = $horas;


}
echo json_encode($datos);
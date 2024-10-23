<?php 
require('../../conf/conexion.php');

$id_med = $_POST['id_med'];
$id_paci = $_POST['id_paci'];
$dia_cita = $_POST['dia_cita'];

$fecha_cita = new DateTime($dia_cita);
$dia_semana_ingles = $fecha_cita->format('l');
$dias_semana_espanol = ['Sunday' => 'Domingo', 'Monday' => 'Lunes', 'Tuesday' => 'Martes', 'Wednesday' => 'Miercoles', 'Thursday' => 'Jueves', 'Friday' => 'Viernes', 'Saturday' => 'Sabado'];

$dia_semana = $dias_semana_espanol[$dia_semana_ingles];

$a = "SELECT M.idmed, CONCAT(M.apellido1, ' ', M.nombre1) AS nom_med, HM.idclinica, C.nombrecentrosalud, HM.dia, HM.desde, HM.hasta
,CM.pacxdia, CM.pacconseg, CM.pacsinseg
FROM medicos M
LEFT JOIN horariomed HM ON M.idmed = HM.idmed
LEFT JOIN clinicas C ON HM.idclinica = C.idclinica
INNER JOIN clinicamedico CM ON (HM.idmed = CM.idmed AND CM.idclinica = HM.idclinica)
WHERE M.idmed = $id_med
AND HM.dia = '$dia_semana'";

$ares=$mysqli->query($a);
$count = mysqli_num_rows($ares);
if ($count > 0) { 

    $data = array();
    while ($row = $ares->fetch_assoc()) {
        $idmed = $row['idmed'];
        $nom_med = $row['nom_med'];
        $idclinica = $row['idclinica'];
        $nombrecentrosalud = $row['nombrecentrosalud'];
        $dia = $row['dia'];
        $desde = $row['desde'];
        $hasta = $row['hasta'];
        $pacxdia = $row['pacxdia'];
        $pacconseg = $row['pacconseg'];
        $pacsinseg = $row['pacsinseg'];
            $data[] = array(
                'idmed' => $idmed,
                'nom_med' => $nom_med,
                'idclinica' => $idclinica,
                'nombrecentrosalud' => $nombrecentrosalud,
                'dia' => $dia,
                'desde' => $desde,
                'hasta' => $hasta,
                'pacxdia' => $pacxdia,
                'pacconseg' => $pacconseg,
                'pacsinseg' => $pacsinseg
            );
    }
    echo json_encode($data);



} else {
    echo "No se encontraron resultados.";
}
// $row = $ares->fetch_assoc();
// $idclinica = $row['idclinica'];

// echo $idclinica;


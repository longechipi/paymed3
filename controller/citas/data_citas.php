<?php 
//---------- CONSULTA GENERAL PARA TODAS LAS CONSULTAS DEL MEDICO
$a="SELECT C.idcita, C.idpaci, C.historia, DATE_FORMAT(C.fechacita, '%m/%d/%Y') AS fechacita, C.horacita, CONCAT(C.apellido, ' ', C.nombre) AS nom_paci,
C.telefono, C.correo, motivo, A.razsocial, CL.nombrecentrosalud, C.idmed, SA.servicio, C.idestatus, E.estatus
FROM citas C
LEFT JOIN aseguradores A ON C.idaseg = A.idaseg
LEFT JOIN clinicas CL ON C.idclinica = CL.idclinica
LEFT JOIN serviciosafiliados SA ON C.idservaf = SA.idservaf
LEFT JOIN estatus E ON C.idestatus = E.idestatus
WHERE YEAR(C.fechacita) = YEAR(NOW())
AND C.idmed = $idmedico ";
$ares=$mysqli->query($a);

$clientes = array();
while ($row = mysqli_fetch_assoc($ares)) {
    //-------- ESTATUS DE LA CITA ---------//
    switch ($row['idestatus']){
        //------ PENDIENTE ------//
        case 3:
            $clientes[] = array(
                'id' => $row['idcita'], //ID unico de la Cita
                'name' => 'Cita Medica', //Nombre del Titulo
                // 'badge' => '<button type="button" class="hora" data-bs-toggle="modal" data-bs-target="#modaldatehora-' . $row['idcita'] . '">' .$row['horacita']. '</button>', //Hora formato 12 am/pm
                'date' => $row['fechacita'],
                'description' => $row['motivo'],
                'type' => 'event'
            );
            break;
        case 6:
            echo "ESTOY EN CITA CONFIRMADA";
            break;
        case 7:
            echo "ESTOY EN CITA REALIZADA";
            break;
    }
}
$json_string = json_encode($clientes);





?>
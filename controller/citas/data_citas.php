<?php 
//---------- CONSULTA GENERAL PARA TODAS LAS CONSULTAS DEL MEDICO
$a="SELECT C.idcita, C.idpaci, C.historia, DATE_FORMAT(C.fechacita, '%m/%d/%Y') AS fechacita, 
TIME_FORMAT(C.horacita, '%h:%i %p') AS horacita, P.cedula, CONCAT(C.apellido, ' ', C.nombre) AS nom_paci,
C.telefono, C.correo, C.motivo, A.razsocial, CL.nombrecentrosalud, C.idmed, SA.servicio, C.idestatus, E.estatus
FROM citas C
LEFT JOIN aseguradores A ON C.idaseg = A.idaseg
LEFT JOIN clinicas CL ON C.idclinica = CL.idclinica
LEFT JOIN serviciosafiliados SA ON C.idservaf = SA.idservaf
LEFT JOIN estatus E ON C.idestatus = E.idestatus
LEFT JOIN pacientes P ON C.idpaci = P.idpaci
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
                'badge' => $row['horacita'] .'<hr>',
                'date' => $row['fechacita'],
                'description' => "<strong>Paciente: </strong>" . $row['nom_paci'] . "<br>
                                  <strong>Cédula: </strong>" . $row['cedula'] . "<br>
                                  <strong>Historia: </strong>" . $row['historia'] . "<br>
                                  <strong>Telf: </strong>" . $row['telefono'] . "<br>
                                  <strong>Motivo: </strong>" . $row['motivo'] . "<br>
                                  <div class='alert alert-warning mt-3' role='alert'>" . $row['estatus'] . "</div>".
                                  "<div class='text-center'><a class='btn btn-primary' data-cita-id='" . $row['idcita'] . "'href='#' rel='noopener noreferrer'>Opciones</a> </div>",
                                  
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
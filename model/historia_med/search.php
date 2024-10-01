<?php
	require('../../conf/conexion.php');

$ced_paci = $_POST['ced'];
$idmed = $_POST['idmed']; 

//----------- SE BUSCA EL PACIENTE PRIMERO ------------//
$a = "SELECT * FROM pacientes WHERE SUBSTRING(cedula, 2)=$ced_paci ";
$ares=$mysqli->query($a);
    if ($ares->num_rows > 0) {
       // echo "SI";
        $datos_paci = $ares->fetch_assoc();
        if($datos_paci['idmed']==$idmed){
            //echo "SI ES EL MISMO MEDICO";
            $idpaci = $datos_paci['idpaci'];
            //------------ DATOS DE LA CONSULTA PREVIA -------------//
            $b ="SELECT CM.idpaci, CM.fechadia, CM.idcita, CM.hora, CONCAT(P.apellido1,' ', P.nombre1) AS nom_paci, SUBSTRING(P.cedula, 2) AS Cedula, P.edad
                FROM consultas_med CM
                INNER JOIN pacientes P ON CM.idpaci = P.idpaci
                WHERE CM.idpaci = $idpaci";
                $bres=$mysqli->query($b);
                    if ($bres->num_rows > 0) {
                        $data = array();
                        while ($datos_cons = $bres->fetch_assoc()) {
                            $data[] = array(
                                'IDPACI' => $datos_cons['idpaci'],
                                'IDCITA' => $datos_cons['idcita'],
                                'FECHACONSU' => $datos_cons['fechadia'],
                                'HORACONSU' => $datos_cons['hora'],
                                'NOM_PACI' => $datos_cons['nom_paci'],
                                'CEDULA' => $datos_cons['Cedula'],
                                'EDAD' => $datos_cons['edad']
                            );
                        }
                        echo json_encode($data);

                    }else{
                        echo "ERROCONSUL";
                    }

        }else{
            echo "NO ES OTRO MEDICO";
        } 







        
    }else{
        echo "NO EXISTE PACIENTE";
    }
?>
